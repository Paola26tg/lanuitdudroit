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
use Mail;



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

       $event = Event::where('idEvent', $request->idEvent)
           ->first();

        $data = array(
            'name'=>$attendee->name,
            'event'=>$event->eventTitle,
            'date'=>$event->start,
            'lieu'=>$event->location
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
}
