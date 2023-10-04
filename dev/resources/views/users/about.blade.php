@extends('template.userTemplate')
@section('title')
A propos | La nuit Du Droit
@endsection
@section('content')
<!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-text">
              <h2>Qui sommes-nous ?</h2>
              <div class="bt-option">
                <a href="#">Accueil</a>
                <span>A Propos</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- About Section Begin -->
    <section class="about-section spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <h2>Ce Qui Nous Définis</h2>
              <p class="f-para">
                 {!!$home->about!!}
              </p>
              <p>
                
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="about-pic">
              <img src="{{asset('storage/home/'.$home->aboutCover)}}" alt="" />
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-text">
              <h3>Notre Histoire</h3>
              <p>
               {!!$home->description!!}
              </p>
              {{-- <ul>
                <li>
                  <span class="icon_check"></span> Write On Your Business Card
                </li>
                <li><span class="icon_check"></span> Advertising Outdoors</li>
                <li>
                  <span class="icon_check"></span> Effective Advertising
                  Pointers
                </li>
                <li>
                  <span class="icon_check"></span> Kook 2 Directory Add Url Free
                </li>
              </ul> --}}
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- About Section End -->

    <!-- Team Member Section Begin -->
    <section class="team-member-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <h2>Notre équipe</h2>
              <p>
                Découvrez notre équipe dynamique et talentieuse..
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        @foreach($members as $member)
        <div
          class="member-item set-bg"
          data-setbg="{{asset('storage/members/'.$member->cover)}}"
        >
          <div class="mi-social">
            <div class="mi-social-inner bg-gradient">
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-instagram"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="{{$member->social_link}}"><i class="fa fa-linkedin"></i></a>
            </div>
          </div>
          <div class="mi-text">
            <h5>{{$member->name}}</h5>
            <span>{{$member->post_occupied}}</span>
          </div>
        </div>
        @endforeach
      </div>
    </section>
    <!-- Team Member Section End -->
    @endsection