@extends('template.userTemplate')
@section('title')
Évènement - Détails | La nuit du Droit
@endsection
@section('content')
  <!-- Blog Details Hero Section Begin -->
    <section class="blog-hero-section set-bg" data-setbg="{{asset('storage/events/'.$event->eventCover)}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bh-text">
                        <a href="" class="play-btn video-popup"><i
                                class="fa fa-play"></i></a>
                        <h2>Revivez les moments forts de l'évènement : {{$event->eventTitle}} </h2>
                        <ul>
                              @php
                            $start = $event->start;
                              $start = DateTime::createFromFormat('Y-m-d',$start);
                                    setlocale(LC_TIME, "fr_FR.UTF-8");
                                    $start = strftime("%e %B %Y", $start->getTimestamp());
                            @endphp
                            <li>{{$start}}</li>
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero Section End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="bd-text">
                        <div class="bd-quote">
                            <p>{{$event->description}}</p>
                            <span>Mot d'ordre</span>
                            <img src="{{asset('users/img/quote-left.png')}}"/>
                        </div>
                    </div>
                </div>
                        <h3 class="fw-bold mb-5" style="font-weight: 600;">Les moments forts en images </h3>
                    </br>
                    </br>
                    
                            <div class="row">
                                @foreach($galleries as $gallery)
                                <div class="col-md-4 mb-4">
                                    <a href="{{asset('storage/galleries/'.$gallery->cover)}}" class="img-popup">
                                    <img src="{{asset('storage/galleries/'.$gallery->cover)}}" alt="" class="img-fluid rounded"" >
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        
                     {{--    <div class="bd-tag-share">
                            
                            <div class="s-share">
                                <span>Partagez:</span>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div> --}}
                    </div>
                </div>
    </section>
    <!-- Blog Details Section End -->
    @endsection