<?php

namespace App\Http\Controllers;

use App\Mail\CustomMail;
use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Event;
use App\Models\Speaker;
use App\Models\Calendar;
use App\Models\Partner;
use App\Models\Attendee;
use App\Models\Member;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;
use Mail;
use PDF;



class UserController extends Controller
{
     public function getHome()
    {
        $home = Home::get()->first();

        $event = Event::where('isEnable', true)->get()->first();
        $events = Event::latest()->take(3)->get();
        $calendars = null;
        $speakers = null;
        if(!empty($event)){
            $calendars = Calendar::where('idEvent',$event->idEvent)
        ->get();
        $speakers = Speaker::where('idEvent',$event->idEvent)
        ->limit(6)->get();
        }

        $partners = Partner::all();
        return view('users.homeUser')
        ->withEvent($event)
        ->withCalendars($calendars)
        ->withEvents($events)
        ->withSpeakers($speakers)
        ->withPartners($partners)
        ->withHome($home);

    }

    public function getAbout()
    {
         $home = Home::get()->first();
         $members = Member::all();
        return view('users.about')
        ->withHome($home)
        ->withMembers($members);

    }
    public function getContact()
    {
        $home = Home::get()->first();
        $event = Event::where('isEnable', true)->get()->first();
        return view('users.contact')
        ->withHome($home)
        ->withEvent($event);
    }
     public function getSpeakers()
    {
        $event = Event::where('isEnable', true)->get()->first();
        if(!empty($event)){
        $speakers = Speaker::where('idEvent',$event->idEvent)
        ->limit(6)->get();
        }

        return view('users.speakers')
        ->withSpeakers($speakers);
    }
     public function getEvents()
    {
        $events = Event::limit(10)->get();
        return view('users.events')
        ->withEvents($events);
    }

     public function getEventDetails($idEvent)
    {
        $event = Event::where('idEvent', decodeId($idEvent))->get()->first();
        $galleries = Gallery::join('events', 'galleries.idEvent', '=', 'events.idEvent')
        ->select('events.*', 'galleries.*')
        ->where('galleries.idEvent', decodeId($idEvent))
        ->get();

        return view('users.eventDetails')
        ->withEvent($event)
        ->withGalleries($galleries);
    }

     public function getAttendForm()
    {
        $event = Event::where('isEnable', true)->get()->first();
        return view('users.attendForm')
        ->withEvent($event);
    }
    public function storeAttend(Request $request)
    {
       $attendee = new Attendee();
       $attendee->idEvent = $request->idEvent;
       $attendee->name = $request->name;
       $attendee->email = $request->email;
       $attendee->phone = $request->phone;
       $attendee->job = $request->job;
       $attendee->age = $request->age;
       $attendee->source = $request->source;
       $attendee->comment = $request->comment;
       $attendee->is_student = $request->is_student;

        $include_chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        /* Uncomment below to include symbols */
        /* $include_chars .= "[{(!@#$%^/&*_+;?\:)}]"; */
        $charLength = strlen($include_chars);
        $randomString = '';

        do {
            for ($i = 0; $i < 120; $i++) {
                $randomString .= $include_chars [rand(0, $charLength - 1)];
            }
        } while (self::slugExisteDeja($randomString));

        $attendee->slug = $randomString;


       $event = Event::where('idEvent', $request->idEvent)
           ->first();

        $data = array(
            'name'=>$attendee->name,
            'event'=>$event->eventTitle,
            'date'=>$event->start,
            'lieu'=>$event->location,
            'slug'=>$attendee->slug
        );
        Mail::to($attendee->email)->send(new CustomMail($data, 'mails.inscription', 'Confirmation d\'Inscription à la Nuit du Droit - 18 Novembre'));

        return $attendee->save()?1:0;
    }

    public function postContact(Request $request){
        $data = array(
            'name'=>$request->nom,
            'email'=>$request->email,
            'telephone'=>$request->tel,
            'message'=>$request->message
        );
        Mail::to('contact@lanuitdudroit.com')->send(new CustomMail($data, 'mails.contact', 'Nouveau message'));

        return 1;
    }

    private static function slugExisteDeja($slug)
    {
        return DB::table('attendees')->where('slug', $slug)->exists();
    }

    public function confirPayment($slug){
         $attendee = Attendee::where('slug', $slug)->first();
         return view('users.confirmPayment', compact('attendee'));
    }

    public function saveConfirmPayment(Request $request){
        $this->validate(request(), [
            'phone' => 'required',
            'reference' => 'required',
        ]);

        $attendee = Attendee::find($request->idAttendee);
        $attendee->phone_transaction = $request->phone;
        $attendee->waiting = 0;
        $attendee->reference_transaction = $request->reference;

        $attendee->save();

        return view('users.confirmSuccess');
    }

    public function myTicket($slug){
        $attendde = Attendee::where('slug', $slug)
            ->first();
        if($attendde->payed == 0){
            abort(404);
        }
        $data = [
            'reference'=>$attendde->reference_transaction,
            'name'=> $attendde->name,
        ];
        $customPaper = array(0,0,360,740);
        $pdf = PDF::loadView('reports.ticket', $data)->setPaper($customPaper);
        //$pdf = PDF::loadView('reports.ticket', $data);
        return $pdf->stream('ticket_'.$attendde->slug.'.pdf');
        //return view('reports.ticket');
    }
}
