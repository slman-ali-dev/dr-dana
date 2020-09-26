<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PatientReview;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $events = [];

        $reviews = PatientReview::all();
        foreach ($reviews as $review) {
            $events[] = [
                "title" => $review->patient_with_id,
                "start" => $review->date,
                "url" => backpack_url("patientreview/$review->id/show")
            ];
        }

        return view('calendar')->with(["events" => $events]);
    }
}
