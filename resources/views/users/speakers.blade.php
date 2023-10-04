@extends('template.userTemplate')
@section('title')
Panélistes | La nuit du Droit
@endsection
@section('content')
<!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Nos panélistes</h2>
                        <div class="bt-option">
                            <a href="#">Accueil</a>
                            <span>Nos Panélistes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Speaker Section Begin -->
    <section class="speaker-section spad">
        <div class="container">
            <div class="row">
               @foreach($speakers as $speaker)
                <div class="col-sm-6">
                    <div class="speaker-item">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="si-pic">
                                    <img src="{{asset('storage/speakers/'.$speaker->cover)}}" height="320" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="si-text">
                                    <div class="si-title">
                                        <h4>{{$speaker->name}}</h4>
                                        <span>Panéliste</span>
                                    </div>
                                    <div class="si-social">
                                        <a href="{{$speaker->social_link}}"><i class="fa fa-linkedin"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                    </div>
                                    <p>{{$speaker->job}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          @endforeach
            </div>
            <div class="load-more">
                <a href="#" class="primary-btn">Charger plus</a>
            </div>
        </div>
    </section>
    <!-- Speaker Section End -->
    @endsection