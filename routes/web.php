<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Adapter\Local;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/admin');;
});

Route::group([
    'namespace'  => 'Admin',
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
], function () {
    Route::get('backup', function () {

        if (!count(config('backup.backup.destination.disks'))) {
            dd(trans('backpack::backup.no_disks_configured'));
        }

        $this->data['backups'] = [];

        foreach (config('backup.backup.destination.disks') as $disk_name) {
            $disk = Storage::disk($disk_name);
            $adapter = $disk->getDriver()->getAdapter();
            $files = $disk->allFiles();

            // make an array of backup files, with their filesize and creation date
            foreach ($files as $k => $f) {
                // only take the zip files into account
                if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                    $this->data['backups'][] = [
                        'file_path'     => $f,
                        'file_name'     => str_replace('backups/', '', $f),
                        'file_size'     => $disk->size($f),
                        'last_modified' => $disk->lastModified($f),
                        'disk'          => $disk_name,
                        'download'      => ($adapter instanceof Local) ? true : false,
                    ];
                }
            }
        }

        // reverse the backups, so the newest one would be on top
        $this->data['backups'] = array_reverse($this->data['backups']);
        $this->data['title'] = 'Backups';

        return view('backupmanager::backup', $this->data);
    })->name('backup.index');


    Route::put('backup/create', function () {

        $message = 'success';

        try {
            ini_set('max_execution_time', 600);

            Log::info('Backpack\BackupManager -- Called backup:run from admin interface');

            Artisan::call('backup:run --only-db');

            $output = Artisan::output();

            if (strpos($output, 'Backup failed because')) {
                preg_match('/Backup failed because(.*?)$/ms', $output, $match);
                $message = "Backpack\BackupManager -- backup process failed because ";
                $message .= isset($match[1]) ? $match[1] : '';
                Log::error($message . PHP_EOL . $output);
            } else {
                Log::info("Backpack\BackupManager -- backup process has started");
            }
        } catch (Exception $e) {
            Log::error($e);

            return Response::make($e->getMessage(), 500);
        }

        return $message;
    })->name('backup.store');


    Route::get('backup/download/{file_name?}', function () {
        $disk = Storage::disk(Request::input('disk'));
        $file_name = Request::input('file_name');
        $adapter = $disk->getDriver()->getAdapter();

        if ($adapter instanceof Local) {
            $storage_path = $disk->getDriver()->getAdapter()->getPathPrefix();

            if ($disk->exists($file_name)) {
                return response()->download($storage_path . $file_name);
            } else {
                abort(404, trans('backpack::backup.backup_doesnt_exist'));
            }
        } else {
            abort(404, trans('backpack::backup.only_local_downloads_supported'));
        }
    })->name('backup.download');


    Route::delete('backup/delete/{file_name?}', function ($file_name) {
        $disk = Storage::disk(Request::input('disk'));

        if ($disk->exists($file_name)) {
            $disk->delete($file_name);

            return 'success';
        } else {
            abort(404, trans('backpack::backup.backup_doesnt_exist'));
        }
    })->where('file_name', '(.*)')->name('backup.destroy');
});
