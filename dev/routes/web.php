<?php

use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Users routes
Route::get('/','UserController@getHome')->name('home');
Route::get('/about-us','UserController@getAbout')->name('about');
Route::get('/speakers','UserController@getSpeakers')->name('speakers');
Route::get('/events','UserController@getEvents')->name('events');
Route::get('/event-details/{idEvent}','UserController@getEventDetails')->name('event-details');
Route::get('/contact','UserController@getContact')->name('contact');
Route::get('/attendForm','UserController@getAttendForm')->name('attend-form');
Route::get('/confirmPayment/{slug}','UserController@confirPayment')->name('confirm-payment');
Route::post('/saveconfirmPayment','UserController@saveConfirmPayment')->name('save-confirm-payment');
Route::post('/storeAttend','UserController@storeAttend')->name('store-attend');
Route::post('/contact-us','UserController@postContact')->name('contact-us');



//Roots routes
Route::prefix('ndd-admin')->group(function(){

    Route::middleware('prevent-back-history')->group(function () {
    Route::get('/','RootController@getLogin')->name('login');
     Route::get('/auth-forgot-password','RootController@getAuthForgotPassword')->name('auth-forgot-password');
    Route::post('/login','RootController@login')->name('login-root');
    Route::get('/dashboard','RootController@getDashboard')->name('dashboard');
    Route::get('/logout', 'RootController@logout')->name('log-out');
    Route::get('/profile', 'RootController@getAdminProfile')->name('profile');

    Route::get('/events-list','RootController@getEventsList')->name('events-list');
    Route::post('/storeEvent','RootController@storeEvent')->name('store-event');
    Route::post('/storeEventCalendar','RootController@storeEventCalendar')->name('store-event-calendar');
    Route::get('/event-calendar-list/{eventID}','RootController@getEventCalendarList')->name('event-calendar-list');
    Route::get('/delete-event/{idEvent}','RootController@deleteEvent')->name('delete-event');

    Route::get('/event-calendar-speaker-list/{calendarID}','RootController@getEventCalendarSpeakerList')->name('event-calendar-speaker-list');

    Route::post('/storeEventCalendarSpeaker','RootController@storeEventCalendarSpeaker')->name('store-event-calendar-speaker');

    Route::get('/event-calendar-activity-list/{calendarID}','RootController@getEventCalendarActivityList')->name('event-calendar-activity-list');
    Route::post('/storeEventCalendarActivity','RootController@storeEventCalendarActivity')->name('store-event-calendar-activity');
    Route::get('/delete-calendar/{idCalendar}','RootController@deleteCalendar')->name('delete-calendar');

    Route::get('/speakers-list','RootController@getSpeakersList')->name('speakers-list');
    Route::get('/delete-speaker/{idSpeaker}','RootController@deleteSpeaker')->name('delete-speaker');

    Route::get('/activities-list','RootController@getActivityList')->name('activity-list');
    Route::get('/delete-activity/{idActivity}','RootController@deleteActivity')->name('delete-activity');

    Route::get('/partners-list','RootController@getPartnersList')->name('partners-list');
    Route::post('/store-partner','RootController@storePartner')->name('store-partner');
    Route::get('/delete-partner/{idPartner}','RootController@deletePartner')->name('delete-partner');

    Route::get('/home-custom','RootController@getHomeCustom')->name('home-custom');
    Route::post('/homeCustom','RootController@updateHomeCustom')->name('updateHome-custom');

    Route::get('/about-custom','RootController@getAboutCustom')->name('about-custom');
    Route::post('/aboutCustom','RootController@updateAboutCustom')->name('updateAbout-custom');

    Route::get('/advertises','RootController@getAdvertises')->name('advertises');

    Route::get('/members-list','RootController@getMembersList')->name('members-list');
    Route::post('/store-member','RootController@storeMember')->name('store-member');
    Route::get('/delete-member/{idMember}','RootController@deleteMember')->name('delete-member');

    Route::get('/attendees-list','RootController@getAttendeesList')->name('attendees-list');

    Route::get('/event-gallery-list/{eventID}','RootController@getEventGalleryList')->name('event-gallery-list');
    Route::post('/storeEventGallery','RootController@storeEventGallery')->name('store-event-gallery');
    Route::get('/delete-gallery/{idGallery}','RootController@deleteGallery')->name('delete-gallery');

    Route::get('/checkPayment/{slug}','RootController@checkPayment')->name('check-payment');
    Route::post('/saveCheckPayment','RootController@saveCheckPayment')->name('save-check-payment');
    Route::get('/waitingPaymentList','RootController@getWaitingPaymentList')->name('waiting-payment-list');

     });
});
