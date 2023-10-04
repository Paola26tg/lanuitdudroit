<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Home;
use App\Models\Event;
use App\Models\Calendar;
use App\Models\Speaker;
use App\Models\Activity;
use App\Models\Partner;
use App\Models\Attendee;
use App\Models\Member;
use App\Models\Gallery;



class RootController extends Controller
{
    public function getLogin()
    {
        return view('roots.login');
    }
    public function getAuthForgotPassword()
    {
        return view('roots.authForgotPassword');
    }
    public function logout()
    {
    Auth::logout(); 
    Session::flush();
    Session::regenerateToken();
    return redirect()->route('login'); 
    }

    public function login(Request $request){
         $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Tentative de connexion de l'utilisateur
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
         $request->session()->regenerate();
        $request->session()->put('user', auth()->user());
        return response()->json(['message' => 'Connexion réussie.',
                                'dashboard'=> route("dashboard", [auth()->user()->id] ) ]);
    }

    // Si la tentative de connexion échoue, renvoyer une erreur
    return response()->json(['message' => 'Email ou mot de passe incorrect.'], 401);
    }

    public function getAdminProfile()
    {
        // Récupérer l'utilisateur actuellement connecté (l'administrateur)
    $admin = auth()->user();
    
    // Vérifier si l'utilisateur est bien authentifié
    if ($admin) {
        // Afficher les informations du profil de l'administrateur
        return view('roots.profile', ['admin' => $admin]);
    } else {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas authentifié
        return redirect()->route('login');
    }
       
    }
    
    public function getDashboard(){
        $home = Home::get()->first();
        $totalPassEvents = Event::where('isEnable', false)->count();

        $currentEvent = Event::where('isEnable', true)->get()->first();
        $recentAttendees = Attendee::join('events', 'events.idEvent', '=', 'attendees.idEvent')
        ->where('attendees.idEvent', $currentEvent->idEvent)
        ->orderByDesc('attendees.created_at')->get();
        $newAttendees = Attendee::whereDate('created_at', '>=', getCurrentWeek('start'))->orderByDesc('created_at')->get();
        $attendeesPerEvent = Attendee::select(DB::raw('COUNT(idEvent)as attendee_per_event'))->groupBy('idEvent')->get(); 
        return view('roots.home')
        ->withHome($home)
        ->withTotalPassEvents($totalPassEvents)
        ->withCurrentEvent( $currentEvent)
        ->withRecentAttendees( $recentAttendees)
        ->withNewAttendees($newAttendees)
        ->withAttendeesPerEvent($attendeesPerEvent); 
    }

    public function getHomeCustom(){
       $home = Home::get()->first();
        return view('roots.homeCustom')
        ->withHome($home);
    }

     public function updateHomeCustom(Request $request ){

        $home = Home::get()->first();
        if(empty($home)){
            $home = new Home();  
        }
         if($request->hasFile('banner') && $request->file('banner')->isValid()){
            $file = $request->file('banner');
            $path = $file->store('home','public');
            $home->banner = $file->hashName(); 
        }
        $home->title = $request->title;
        $home->description = $request->description;

        return $home->save();
       
    }



    public function getAboutCustom(){
        $home = Home::get()->first();
        return view('roots.aboutCustom')
        ->withHome($home);
        
    }

     public function updateAboutCustom(Request $request ){

        $home = Home::get()->first();
         if(empty($home)){
            $home = new Home();  
        }
        if($request->hasFile('aboutCover') && $request->file('aboutCover')->isValid()){
            $file = $request->file('aboutCover');
            $path = $file->store('home','public');
            $home->aboutCover = $file->hashName(); 
        }
        $home->about = $request->about;
        $home->description = $request->description;
        return $home->save();
    }

//Events
    public function getEventsList(){

        $home = Home::get()->first();
        $events = Event::orderByDesc('created_at')
        ->get();

        return view('roots.eventsList')
        ->withEvents($events)
        ->withHome($home);
    }
    public function storeEvent(Request $request){

        if($request->idEvent == null){
        $event = new Event(); 
        $event->eventTitle = $request->subject;
        $event->description = $request->description;

        if($request->hasFile('eventCover') && $request->file('eventCover')->isValid()){
            $file = $request->file('eventCover');
            $path = $file->store('events','public');
            $event->eventCover = $file->hashName(); 
        }
        $event->start = $request->date_deb;
        $event->end = $request->date_fin;
        $event->location = $request->location;
        //$event->edition = $request->edition . 'ème édition' . date('Y');

        $state = $event->save();
    }else{
        $event = Event::where('idEvent', $request->idEvent)->get()->first();
        $event->eventTitle = $request->subject;
        $event->description = $request->description;

        if($request->hasFile('eventCover') && $request->file('eventCover')->isValid()){
            $file = $request->file('eventCover');
            $path = $file->store('events','public');
            $event->eventCover = $file->hashName(); 
        }
        $event->start = $request->date_deb;
        $event->end = $request->date_fin;
        $event->location = $request->location;

      $state = $event->save();
    }
     return $state;
    }
     public function deleteEvent($idEvent){
        try {
        $event = Event::findOrFail($idEvent);
        $event->delete();
        $successMessage = "Évènement Supprimé";
        return redirect()->back()->with('successMessage', $successMessage);

        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            // Gérer l'exception si aucun enregistrement n'a été trouvé
            $errorMessage = 'Évènement introuvable.';
            return redirect()->back()->with('errorMessage', $errorMessage);  
        }
    }

     // calendar

    public static function getCalendarByIdEvent($id){
        $calendar = Calendar::where('idEvent', $id)->get()->first();
        return $calendar;
    }

     public function storeEventCalendar(Request $request){

        if($request->idCalendar == null){

        $calendar = new Calendar(); 

        $calendar->idEvent = $request->idEvent;
        $calendar->subTitle = $request->activity;
        $calendar->day = $request->day;
        $state = $calendar->save();
        }else{
            $calendar = Calendar::where('idCalendar', $request->idCalendar)->get()->first();
             $calendar->subTitle = $request->activity;
            $calendar->day = $request->day;
            $state = $calendar->save();

        }
        return $state;
    }
    public function getEventCalendarList($eventID){
        $home = Home::get()->first();
        $calendars = Calendar::join('events', 'events.idEvent', '=', 'calendars.idEvent')
        ->where('calendars.idEvent', decodeId($eventID))
        ->select('events.*', 'calendars.*')
        ->orderByDesc('calendars.created_at')
        ->get();
        $event = Event::where('idEvent', decodeId($eventID))->get()->first();
        return view('roots.eventCalendarList')
        ->withCalendars($calendars)
        ->withEvent($event)
        ->withEventID(decodeId($eventID))
        ->withHome($home);
    }

     public static function getSpeakerByIdCalendar($id){
        $speaker = Speaker::where('idCalendar', $id)->get()->first();
        return $speaker;
    }
     public static function getSpeakersByIdCalendar($id){
        $speakers = Speaker::where('idCalendar', $id)->get();
        return $speakers;
    }

     public static function getActivityByIdCalendar($id){
        $activity = Activity::where('idCalendar', $id)->get()->first();
        return $activity;
    }
      public static function getActivitiesByIdCalendar($id){
        $activities = Activity::where('idCalendar', $id)->get();
        return $activities;
    }

    
    public function getEventCalendarSpeakerList($calendarID){
        $home = Home::get()->first();
        $speakers = Speaker::join('events', 'events.idEvent', '=', 'speakers.idEvent')
        ->join('calendars', 'calendars.idCalendar', '=', 'speakers.idCalendar')
        ->where('speakers.idCalendar', decodeId($calendarID))
        ->select('events.*', 'calendars.*','speakers.*' )
        ->orderByDesc('speakers.created_at')
        ->get();
        $calendar = Calendar::where('idCalendar', decodeId($calendarID))->get()->first();
        return view('roots.eventCalendarSpeakerList')
        ->withSpeakers($speakers)
        ->withCalendar($calendar)
        ->withCalendarID($calendarID)
        ->withHome($home);
    }
    public function getEventCalendarActivityList($calendarID){
        $home = Home::get()->first();
        $activities = Activity::join('events', 'events.idEvent', '=', 'activities.idEvent')
        ->join('calendars', 'calendars.idCalendar', '=', 'activities.idCalendar')
        ->where('activities.idCalendar', decodeId($calendarID))
        ->select('events.*', 'calendars.*','activities.*' )
        ->orderByDesc('activities.created_at')
        ->get();
        $calendar = Calendar::where('idCalendar', decodeId($calendarID))->get()->first();
        return view('roots.eventCalendarActivityList')
        ->withActivities($activities)
        ->withCalendar($calendar)
        ->withCalendarID($calendarID)
        ->withHome($home);
    }

    public function storeEventCalendarSpeaker(Request $request){

        if($request->idSpeaker == null){

        $speaker = new Speaker(); 

        $speaker->idEvent = $request->idEvent;
        $speaker->idCalendar = $request->idCalendar;
        $speaker->name = $request->name;
        $speaker->job = $request->job;
        $speaker->social_link = $request->social_link;

        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $file = $request->file('cover');
            $path = $file->store('speakers','public');
            $speaker->cover = $file->hashName(); 
        }
        $state = $speaker->save();
    }else{
        $speaker = Speaker::where('idSpeaker',$request->idSpeaker)->first();
        $speaker->idEvent = $request->idEvent;
        $speaker->idCalendar = $request->idCalendar;
        $speaker->name = $request->name;
        $speaker->job = $request->job;
        $speaker->social_link = $request->social_link;

        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $file = $request->file('cover');
            $path = $file->store('speakers','public');
            $speaker->cover = $file->hashName(); 
        }

        $state = $speaker->save();
    }
    return $state;
    }

    public function storeEventCalendarActivity(Request $request){

        if($request->idActivity == null){

        $activity = new Activity(); 

        $activity->idEvent = $request->idEvent;
        $activity->idCalendar = $request->idCalendar;
        $activity->activity = $request->name;
        $activity->time = $request->time_s.' - '. $request->time_e;
        $state = $activity->save();
    }else{
        $activity = Activity::where('idActivity',$request->idActivity)->first();
        $activity->idEvent = $request->idEvent;
        $activity->idCalendar = $request->idCalendar;
        $activity->activity = $request->name;
        $activity->time = $request->time_s.' - '. $request->time_e;
       
        $state = $activity->save();
    }
    return $state;
    }

    public function deleteCalendar($idCalendar){
        try {
        $calendar = Calendar::findOrFail(decodeId($idCalendar));
        $calendar->delete();
        $successMessage = "Programme Supprimé";
        return redirect()->back()->with('successMessage', $successMessage);

        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            // Gérer l'exception si aucun enregistrement n'a été trouvé
            $errorMessage = 'Programme introuvable.';
            return redirect()->back()->with('errorMessage', $errorMessage);  
        }
    }


     public function deleteSpeaker($idSpeaker){
        try {
        $speaker = Speaker::findOrFail(decodeId($idSpeaker));
        $speaker->delete();
        $successMessage = "Panéliste Supprimé";
        return redirect()->back()->with('successMessage', $successMessage);

        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            // Gérer l'exception si aucun enregistrement n'a été trouvé
            $errorMessage = 'Partenaire introuvable.';
            return redirect()->back()->with('errorMessage', $errorMessage);  
        }
    }

      public function deleteActivity($idActivity){
        try {
        $activity = Activity::findOrFail(decodeId($idActivity));
        $activity->delete();
        $successMessage = "Activité Supprimé";
        return redirect()->back()->with('successMessage', $successMessage);

        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            // Gérer l'exception si aucun enregistrement n'a été trouvé
            $errorMessage = 'Partenaire introuvable.';
            return redirect()->back()->with('errorMessage', $errorMessage);  
        }
    }

    //partner

    public function getPartnersList(){
        $home = Home::get()->first();
        $partners= Partner::all();
        return view('roots.partnersList')
        ->withPartners($partners)
        ->withHome($home);
    }
    public function storePartner(Request $request){
        if($request->id == null){
        $partner = new Partner(); 
        $partner->name = $request->name;
        $partner->description = $request->description;

        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $file = $request->file('cover');
            $path = $file->store('partners','public');
            $partner->cover = $file->hashName(); 
        }

        $state = $partner->save();
    }else{
        $partner = Partner::where('id', $request->id)->first();
        $partner->name = $request->name;
        $partner->description = $request->description;

        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $file = $request->file('cover');
            $path = $file->store('partners','public');
            $partner->cover = $file->hashName(); 
        }
       $state = $partner->save();
    }
      return $state;
    }

    public function deletePartner($idPartner){
        try {
        $partner = Partner::findOrFail(decodeId($idPartner));
        $partner->delete();
        $successMessage = "Partenaire Supprimé";
        return redirect()->back()->with('successMessage', $successMessage);

        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            // Gérer l'exception si aucun enregistrement n'a été trouvé
            $errorMessage = 'Partenaire introuvable.';
            return redirect()->back()->with('errorMessage', $errorMessage);  
        }
    }

    //Members

     public function storeMember(Request $request){
        if($request->idMember == null){
        $member = new Member(); 
        $member->name = $request->name;
        $member->email = $request->email;
        $member->job = $request->job;
        $member->post_occupied = $request->post_occupied;
        $member->social_link = $request->social_link;

        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $file = $request->file('cover');
            $path = $file->store('members','public');
            $member->cover = $file->hashName(); 
        }
        $state= $member->save();
    }else{
        $member = Member::where('idMember', $request->idMember)->first();
        $member->name = $request->name;
        $member->email = $request->email;
        $member->job = $request->job;
        $member->post_occupied = $request->post_occupied;
        $member->social_link = $request->social_link;

        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $file = $request->file('cover');
            $path = $file->store('members','public');
            $member->cover = $file->hashName(); 
        }
        $state= $member->save();

    }
    return $state;
    }

     public function deleteMember($idMember){
        try {
        $member = Member::findOrFail(decodeId($idMember));
        $member->delete();
        $successMessage = "Membre Supprimé";
        return redirect()->back()->with('successMessage', $successMessage);

        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            // Gérer l'exception si aucun enregistrement n'a été trouvé
            $errorMessage = 'Membre introuvable.';
            return redirect()->back()->with('errorMessage', $errorMessage);  
        }
    }


    public function getMembersList(){
        $home = Home::get()->first();
        $members= Member::all();
        return view('roots.membersList')
        ->withMembers($members)
        ->withHome($home);
    }

    public function getSpeakersList(){
        $home = Home::get()->first();
        $speakers = Speaker::join('events', 'events.idEvent', '=', 'speakers.idEvent')
        ->join('calendars', 'calendars.idCalendar', '=', 'speakers.idCalendar')
        ->select('events.*', 'calendars.*','speakers.*' )
        ->orderByDesc('speakers.created_at')
        ->get();

        return view('roots.speakersList')
        ->withSpeakers($speakers)
        ->withHome($home);
    }

    public function getAttendeesList(){
        $home = Home::get()->first();
         $attendees = Attendee::join('events', 'events.idEvent', '=', 'attendees.idEvent')
        ->select('events.*','attendees.*' )
        ->orderByDesc('attendees.created_at')
        ->get();
        return view('roots.attendeesList')
        ->withAttendees($attendees)
        ->withHome($home);
    }

    public function getAdvertises(){

        return view('roots.advertises');
    }

    //gallery
     public static function getGalleryByIdEvent($id){
        $gallery = Gallery::where('idEvent', $id)->get()->first();
        return $gallery;
    }
    public function getEventGalleryList($eventID){
        $home = Home::get()->first();
        $galleries = Gallery::join('events', 'events.idEvent', '=', 'galleries.idEvent')
        ->where('galleries.idEvent', decodeId($eventID))
        ->select('events.*', 'galleries.*')
        ->orderByDesc('galleries.created_at')
        ->get();
        $event = Event::where('idEvent', decodeId($eventID))->get()->first();
        return view('roots.eventGalleryList')
        ->withGalleries($galleries)
        ->withEvent($event)
        ->withEventID(decodeId($eventID))
        ->withHome($home);
    }

     public function storeEventGallery(Request $request){

        $gallery = new Gallery(); 

        $gallery->idEvent = $request->idEvent;
        $gallery->description = $request->description;
         if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $file = $request->file('cover');
            $path = $file->store('galleries','public');
            $gallery->cover = $file->hashName(); 
        }

        return $gallery->save();
    }
     public function deleteGallery($idGallery){
        try {
        $gallery = Gallery::findOrFail(decodeId($idGallery));
        $gallery->delete();
        $successMessage = "Image Supprimé";
        return redirect()->back()->with('successMessage', $successMessage);

        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            // Gérer l'exception si aucun enregistrement n'a été trouvé
            $errorMessage = 'Image introuvable.';
            return redirect()->back()->with('errorMessage', $errorMessage);  
        }
    }

}
