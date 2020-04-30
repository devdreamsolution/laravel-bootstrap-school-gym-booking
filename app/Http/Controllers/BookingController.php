<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use Response;
use App\Http\Resources\BookingCollection;
use App\Http\Resources\Booking as BookingResource;
use Validator;
use App\Rules\Phone;
use DB;

class BookingController extends Controller
{
    public function index(Request $request)
    {        
        if( $request->ajax() ){
            $datas = DB::table('bookings')->paginate($request->length);
            return new BookingCollection($datas);
        }
        return view('admin.booking');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());
        if( $validator->fails() ){
            $response_data = ['errors' => $validator->getMessageBag()->toArray() ];       
        } else {
            $attr = $request->all();
            $response_data = Booking::create($attr);
           
        }
        return Response::json( $response_data );       
    }   

    public function edit(Booking $contact)
    {
        return new BookingResource($contact);
    }

    public function update(Request $request, Booking $contact)
    {
        $validator = Validator::make($request->all(), $this->rules());
        
        if( $validator->fails() ){
            $response_data = ['errors' => $validator->getMessageBag()->toArray() ];       
        } else {
            $attr = $request->all();
            $contact->update($attr);            
            $response_data = $contact;           
        }

        return Response::json( $response_data ); 
    }

    public function destroy(Booking $contact)
    {
        $booking_id = $contact->id;
        $user_id = auth()->id();
        DB::select("DELETE FROM contacts WHERE user_id = '$user_id' AND activity = '$booking_id'");
        $contact->delete();

    }

    public function request() {
        $rows = DB::select("SELECT a.id, ELT(b.activity, 'swimming pool','indoor running tracks','tennis','football','boxing') activity_name, b.place, b.date, c.name FROM contacts AS a
            LEFT JOIN bookings AS b
            ON a.activity = b.id
            LEFT JOIN users AS c
            ON a.user_id = c.id");
        $xml = '';
        foreach ($rows as $row) {
            $xml .= '<tr><td>'. $row->activity_name .'</td><td>'. $row->place .'</td><td>'. $row->date .'</td><td>'. $row->name .'</td></tr>';
        }
        $data = array(
            'xml'=>$xml
        );
        return view('admin.request')->with($data);
    }

    private function rules(){
        return [
            'activity' => 'required',
            'place' => 'required',
            'date' => 'required',
        ];
    }
}