@extends('template.userTemplate')
@section('title')
Accueil | La nuit du Droit
@endsection
@section('content')
  <!-- Hero Section Begin -->
 
    <section class="hero-section set-bg" data-setbg="{{empty($home)?asset('roots/assets/img/default-banner.png'):asset('storage/home/'.$home->banner)}}">
       
        <div class="container"  >
            <div class="row">
                <div class="col-6">
                    <div class="hero-text">
                        @php
                        $currentDate = date('Y-m-d');
                        @endphp
                        @if(!empty($home))
                        @php
                        $currentDate = date('Y-m-d');
                                    //convertir les date en 24 janvier 2022
                                    if($event->end != null){
                                        $end = DateTime::createFromFormat('Y-m-d', $event->end);
                                    setlocale(LC_TIME, "fr_FR.UTF-8");
                                    $end = strftime("%e %B %Y", $end->getTimestamp());

                                    $start = DateTime::createFromFormat('Y-m-d', $event->start);
                                    setlocale(LC_TIME, "fr_FR.UTF-8");
                                    
                                    $start = strftime("%e %B ", $start->getTimestamp());
                                    }else{
                                        $start = DateTime::createFromFormat('Y-m-d', $event->start);
                                    setlocale(LC_TIME, "fr_FR.UTF-8");

                                    $start = strftime("%e %B %Y", $start->getTimestamp());
                                    }
                                    
                                    
                                    
                                    @endphp
                        @if($event->end != null)
                        <span>{{$start}} Au {{$end}}, {{$event->location}}</span>
                        @else
                        <span>{{$start}}, {{$event->location}}</span>
                        @endif
                        <h2>{{$home->title}}</h2>
                        @endif
                        <a href="{{route('attend-form')}}" class="primary-btn">Réserver son pass</a>
                    </div>
                </div>
              
            </div>
        </div>
    </section> 
   
   
    <!-- Hero Section End -->

    <!-- Counter Section Begin -->
    <section class="counter-section bg-gradientCount">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="counter-text">
                        <span>Date de la conférence</span>
                        <h3>Compter Chaque Seconde <br />Jusqu'à l'Évènement</h3>
                    </div>
                </div>
                <div class="col-lg-8">
                    <input id="dateEvent" hidden value="{{empty($event)?'':$event->start}} 00:00:00"/>
                    <div class="cd-timer" id="countdown">
                        <div class="cd-item">
                            <span>13</span>
                            <p>Days</p>
                        </div>
                        <div class="cd-item">
                            <span>18</span>
                            <p>Hours</p>
                        </div>
                        <div class="cd-item">
                            <span>46</span>
                            <p>Minutes</p>
                        </div>
                        <div class="cd-item">
                            <span>32</span>
                            <p>Seconds</p>
                        </div>
                       
                    </div>
                    
                </div>
                <div class="align-center">
                     <img width="50px" height= "50px" src="{{asset('users/img/icegif-253.gif')}}" {{$currentDate == $event->start?'':'hidden'}} alt="GIF animé">
                </div>
            </div>
        </div>
      
    </section> 
    <!-- Counter Section End -->

    <!-- Home About Section Begin -->
    <section class="home-about-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ha-pic">
                        <img src="{{empty($event)?'asset("roots/assets/img/default-banner.png")':asset('storage/events/'.$event->eventCover)}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ha-text">
                        <h2>Rendez-vous à la nuit du Droit</h2>
                        <p>{{$event->description}}</p>
                        {{-- <ul>
                            <li><span class="icon_check"></span> Write On Your Business Card</li>
                            <li><span class="icon_check"></span> Advertising Outdoors</li>
                            <li><span class="icon_check"></span> Effective Advertising Pointers</li>
                            <li><span class="icon_check"></span> Kook 2 Directory Add Url Free</li>
                        </ul> --}}
                        <div><strong class="text-danger">Présenté par Partick AMENDA</strong></div>

                        <a href="{{route('event-details', encodeId($event->idEvent))}}" class="ha-btn">Découvrir</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home About Section End -->

    <!-- Team Member Section Begin -->
    <section class="team-member-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Nos panélistes</h2>
                        <p> </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
        @foreach($speakers as $speaker)
        <div class="member-item set-bg" data-setbg="{{asset('storage/speakers/'.$speaker->cover)}}">
            <div class="mi-social">
                <div class="mi-social-inner bg-gradient">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="{{$speaker->social_link}}"><i class="fa fa-linkedin"></i></a>
                </div>
            </div>
            <div class="mi-text">
                <h5>{{$speaker->name}}</h5>
                <span>Panéliste</span>
            </div>
        </div>
      @endforeach
        </div>
        </section>
    <!-- Team Member Section End -->

    <!-- Schedule Section Begin -->
    <section class="schedule-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Notre Programme</h2>
                        <p>Ne ratez rien A propos de cet évènement </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="schedule-tab text-center">
                        <ul class="nav nav-tabs" role="tablist">
                              @php
                                    $i = 1;
                                    @endphp
                            @foreach($calendars as $calendar)
                             @php
                              $activitiesCalendar = \App\Http\Controllers\RootController::getActivitiesByIdCalendar($calendar->idCalendar);

                                    //convertir les date en 24 janvier 2022
                                    
                                    $day = DateTime::createFromFormat('Y-m-d', $calendar->day);
                                    setlocale(LC_TIME, "fr_FR.UTF-8");
                                   
                                    $day = strftime("%e %B %Y", $day->getTimestamp());
                                    @endphp
                                    @if(sizeof($activitiesCalendar) != 0)
                            <li class="nav-item">
                                <a class="nav-link {{$i==1? 'active': ''}}" data-toggle="tab" href="#tabs-{{$i}}" role="tab">
                                    <h5>Jour {{$i}} </h5>
                                    <p>{{$day}}</p>
                                </a>
                            </li>
                            @endif
                            @php
                                    $i++;
                                    @endphp
                            @endforeach
                        </ul><!-- Tab panes -->
                        <div class="tab-content">
                           @php
                                    $i = 1;
                                    @endphp
                           @foreach($calendars as $calendar)
                            @php
                             $activities = \App\Http\Controllers\RootController::getActivitiesByIdCalendar($calendar->idCalendar);
                             @endphp
                            <div class="tab-pane {{$i==1? 'active': ''}}" id="tabs-{{$i}}" role="tabpanel">
                                <div class="container"> 
                                    <div class="row">       
                                             @foreach($activities as $activity)
                                            
                                            <div class=" col st-content">
                                                
                                                <div class="sc-text">
                                                   <div><strong><i class="fa fa-clock-o text-danger"></i>     {{$activity->time}}</strong></div> 
                        </br>
                                                     <h4>{{$activity->activity}}</h4>
                                                </div>
                                               
                                            </div>
                                             <i class="fa fa-arrow-right text-danger"></i>
                                       
                                   
                                @endforeach
                                 </div>
                                 </div>
                                 </div> 
                                @php
                                    $i++;
                                    @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Schedule Section End -->

    <!-- Pricing Section Begin -->
   <!--  <section class="pricing-section set-bg spad" data-setbg="img/pricing-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Ticket Pricing</h2>
                        <p>Get your event ticket plan</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-8">
                    <div class="price-item">
                        <h4>1 Day Pass</h4>
                        <div class="pi-price">
                            <h2><span>$</span>129</h2>
                        </div>
                        <ul>
                            <li>One Day Conference Ticket</li>
                            <li>Coffee-break</li>
                            <li>Lunch and Networking</li>
                            <li>Keynote talk</li>
                            <li>Talk to the Editors Session</li>
                        </ul>
                        <a href="#" class="price-btn">Get Ticket <span class="arrow_right"></span></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="price-item top-rated">
                        <div class="tr-tag">
                            <i class="fa fa-star"></i>
                        </div>
                        <h4>Full Pass</h4>
                        <div class="pi-price">
                            <h2><span>$</span>199</h2>
                        </div>
                        <ul>
                            <li>One Day Conference Ticket</li>
                            <li>Coffee-break</li>
                            <li>Lunch and Networking</li>
                            <li>Keynote talk</li>
                            <li>Talk to the Editors Session</li>
                            <li>Lunch and Networking</li>
                            <li>Keynote talk</li>
                        </ul>
                        <a href="#" class="price-btn">Get Ticket <span class="arrow_right"></span></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="price-item">
                        <h4>Group Pass</h4>
                        <div class="pi-price">
                            <h2><span>$</span>79</h2>
                        </div>
                        <ul>
                            <li>One Day Conference Ticket</li>
                            <li>Coffee-break</li>
                            <li>Lunch and Networking</li>
                            <li>Keynote talk</li>
                            <li>Talk to the Editors Session</li>
                        </ul>
                        <a href="#" class="price-btn">Get Ticket <span class="arrow_right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Pricing Section End -->

    <!-- latest BLog Section Begin -->
    <section class="latest-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Nos évènements récents</h2>
                        <p>Que rien ne vous échappe à propos de ce évènement!!</p>
                    </div>
                </div>
            </div>

            @if(!empty($events))
            <div class="row">
                <div class="col-lg-6">
                    @if(!empty($events[2]))
                    <a href="{{route('event-details',encodeId($events[2]->idEvent))}}">
                    <div class="latest-item set-bg-event large-item" data-setbgevent="{{asset('storage/events/'.$events[2]->eventCover)}}">
                        {{-- <a href="{{route('event-details',$events[2]->idEvent)}}">
                        <img src="{{asset('storage/events/'.$events[2]->eventCover)}}"/>
                        <a/> --}}
                        <div class="li-tag {{$events[2]->isEnable?'bg-warning':'bg-danger'}}">{{$events[2]->isEnable?'En cours':'Passé'}}</div> 
                        <div class="li-text">
                            <h4 style="color: white; font-weight:600;">{{$events[2]->eventTitle}} </h4>
                            @php
                            $start1 = $events[2]->start;
                              $start1 = DateTime::createFromFormat('Y-m-d',$start1);
                                    setlocale(LC_TIME, "fr_FR.UTF-8");
                                    $start1 = strftime("%e %B %Y", $start1->getTimestamp());
                            @endphp
                            <span><i class="fa fa-clock-o"></i> {{$start1}}</span>
                        </div>
                    </div>
                    </a>
                    @endif
                </div>
                <div class="col-lg-6">
                    @if(!empty($events[1]))
                    <a href="{{route('event-details',encodeId($events[1]->idEvent))}}">
                    <div class="latest-item set-bg-event" data-setbgevent="{{asset('storage/events/'.$events[1]->eventCover)}}">
                        <div class="li-tag {{$events[1]->isEnable?'bg-warning':'bg-danger'}}">{{$events[1]->isEnable?'En cours':'Passé'}}</div>
                        <div class="li-text">
                            <h4 style="color: white; font-weight:600;">{{$events[1]->eventTitle}}</h4>
                              @php
                            $start2 = $events[1]->start;
                              $start2 = DateTime::createFromFormat('Y-m-d',$start2);
                                    setlocale(LC_TIME, "fr_FR.UTF-8");
                                    $start2 = strftime("%e %B %Y", $start2->getTimestamp());
                            @endphp
                            <span><i class="fa fa-clock-o"></i> {{$start2}}</span>
                        </div>
                    </div>
                    
                    </a>
                    @endif
                    @if(!empty($events[0]))
                     <a href="{{route('event-details',encodeId($events[0]->idEvent))}}">
                    <div class="latest-item set-bg-event" data-setbgevent="{{asset('storage/events/'.$events[0]->eventCover)}}">
                        <div class="li-tag {{$events[0]->isEnable?'bg-warning':'bg-danger'}}">{{$events[0]->isEnable?'En cours':'Passé'}}</div> 
                        <div class="li-text">
                            <h4 style="color: white; font-weight:600;">{{$events[0]->eventTitle}}</h4>
                             @php
                            $start3 = $events[0]->start;
                              $start3 = DateTime::createFromFormat('Y-m-d',$start3);
                                    setlocale(LC_TIME, "fr_FR.UTF-8");
                                    $start3 = strftime("%e %B %Y", $start3->getTimestamp());
                            @endphp
                            <span><i class="fa fa-clock-o"></i> {{$start3}} </span>
                        </div>
                    </div>
                     </a>
                     @endif
                </div>
            </div>
            @endif
        </div>
    </section>
    <!-- latest BLog Section End -->

  <!-- Newslatter Section Begin -->
    <section class="newslatter-section" style="padding-top:200px;">
        <div class="container">
            <div class="newslatter-inner set-bg" data-setbg="{{asset('users/img/newslatter-bg.jpg')}}">
                <div class="ni-text">
                    <h3>Souscrire au newsletter</h3>
                    <p>Souscrivez à notre newsletter pour ne rien manquer de nos actualités </p>
                </div>
                <form action="#" class="ni-form">
                    <input type="text" placeholder="Votre email">
                    <button type="submit">Souscrire</button>
                </form>
            </div>
        </div>
    </section> 
    <!-- Newslatter Section End -->

    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h2>Lieu de la conférence</h2>
                        <p>La localisation de l'évènement</p>
                    </div>
                    <div class="cs-text">
                        <div class="ct-address">
                            <span>Addresse:</span>
                            <p>{{$event->location}} de Lomé, <br />TOGO</p>
                        </div>
                        <ul>
                            <li>
                                <span style="font-style:bold">Tel:</span>
                                <a style="color:brown" href="tel:+228 90 97 53 39">+228 90 97 53 39</a>
                            </li>
                            <li>
                                <span>Email:</span>
                               <a style="color:brown" href="mailto:Contact@lanuitdudroit.com">Contact@lanuitdudroit.com</a>
                            </li>
                        </ul>
                       <!--  <div class="ct-links">
                            <span>Powered by:</span>
                            <p>BIZIYEE COORPORATION</p>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cs-map">
                     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.950894896503!2d1.2630193752485348!3d6.137299993849607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1023e1c43781dcfb%3A0x573d2529a58fa70c!2sMercure%20Lome%20Sarakawa!5e0!3m2!1sfr!2stg!4v1696200056455!5m2!1sfr!2stg" width="600" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection
@section('partners')
<div class="partner-logo owl-carousel">
 @foreach($partners as $partner)
                <a href="#" class="pl-table">
                    <div class="pl-tablecell">
                        <img src="{{asset('storage/partners/'.$partner->cover)}}" alt="">
                    </div>
                </a>
                @endforeach
</div>
@endsection
@section('scripts')
<script>
  
</script>
@endsection