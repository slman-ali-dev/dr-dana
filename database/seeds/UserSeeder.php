<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('qwe123!@#')
        ]);

        $date = Carbon::createFromDate(2020, 1, 1);

        $startOfYear = $date->copy()->startOfYear()->timestamp;
        $endOfYear   = $date->copy()->endOfYear()->timestamp;

        for ($i = 2; $i <= 50; ++$i) {
            $user = new User();
            $user->name = "User$i";
            $user->email = "user$i@gmail.com";
            $user->password = bcrypt("secret");
            $user->created_at = mt_rand($startOfYear,$endOfYear);
            $user->save();
        }
    }
}
