<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Response;
use App\Http\Resources\ContactCollection;
use App\Http\Resources\Contact as ContactResource;
use Validator;
use App\Rules\Phone;
use DB;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        return view('contacts.index');
    }

    public function booking(Request $request)
    {
        $booking_id = $request->input('booking_id');
        $user_id = auth()->id();
        if (DB::select(DB::raw("SELECT * FROM contacts WHERE user_id = '$user_id' AND activity = '$booking_id'"))) {
            echo 'Already Exist';exit;
        } else {
            $result = DB::table('contacts')->insert(['user_id' => $user_id, 'activity' => $booking_id]);
            echo $result;exit;
        }
    }

    public function search(Request $request) {
        $name = $request->input('name');
        $place = $request->input('place');
        $date = $request->input('date');

        $datas = DB::select("SELECT * FROM bookings WHERE place LIKE '%". $place ."%' AND date = '$date' AND activity = '$name'");
        $xml = '';

        foreach ($datas as $data) {
            $activity = '';
            if ($data->activity == '1')
                $activity = 'swimming pool';
            else if ($data->activity == '2')
                $activity = 'indoor running tracks';
            else if ($data->activity == '3')
                $activity = 'tennis';
            else if ($data->activity == '4')
                $activity = 'football';
            else
                $activity = 'boxing';

            $xml .= '<tr id="'. $data->id .'"><td>'. $activity .'</td><td>'. $data->place .'</td><td>'. $data->date .'</td><td><button type="button" class="btn btn-primary btn-xs btn-booking" data-id="'. $data->id .'">Booking</button></td></tr>';
        }
        return $xml;
    }
}