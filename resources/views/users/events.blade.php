@extends('template.userTemplate')
@section('title')
Évènements | La nuit du Droit
@endsection
@section('content')
 <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Nos évènements</h2>
                        <div class="bt-option">
                            <a href="#">Accueil</a>
                            <span>Nos évènements</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
                    <div class="row">
                        @foreach($events as $event)
                        <div class="col-md-6">
                            <a  href="{{route('event-details',encodeId($event->idEvent))}}">
                            <div class="blog-item set-bg-event" data-setbgevent="{{asset('storage/events/'.$event->eventCover)}}">
                                {{-- <div class="bi-tag bg-gradient">{{$event->isEnable?'Active':'Terminé'}}</div> --}}
                                <div class="bi-text">
                                    <h5 style="color: white; font-weight:600;">{{$event->eventTitle}}</h5>
                                     @php
                                    $start = $event->start;
                                    $start = DateTime::createFromFormat('Y-m-d',$start);
                                            setlocale(LC_TIME, "fr_FR.UTF-8");
                                    $start = strftime("%e %B %Y", $start->getTimestamp());
                                    @endphp
                                    <span><i class="fa fa-clock-o"></i> {{$start}}</span>
                                </div>
                            </div>
                            </a>
                        </div>
                       @endforeach
                    </div>
                </div>
            <div class="load-more blog-more">
                <a href="#" class="primary-btn">Charger Plus</a>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
    @endsection