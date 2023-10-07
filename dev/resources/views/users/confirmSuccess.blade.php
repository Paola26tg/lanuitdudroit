@extends('template.userTemplate')
@section('title')
    Confirmer Paiement | La nuit Du Droit
@endsection
@section('content')
    <!-- Contact Top Content Section Begin -->
    <section class="contact-content-section">
    <!--<div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cc-text set-bg-form" data-setbgform="{{asset('users/img/contact-content-bg.jpg')}}" >
                        <div class="row">
                            <div class="col-lg-8 offset-lg-4">
                                <div class="section-title">
                                    <h2>Confirmation de paiement</h2>
                                    <p>Indiquez les informations de paiement </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->

        <div class="container">
            <div class="row">
                <div class="offset-lg-3 col-lg-6">
                    <div class="row" style="margin-top: 1rem">
                        <div class="col-lg-12">
                            <div class="section-title">
                                <h2>Confirmez votre paiement!!</h2>
                                <p>Opération réussie. Nous allons procéder à la vérifications de vos informations.
                                    Nous vous enverrons un mail suite aux vérifications.</p>
                            </div>
                        </div>
                    </div>
                    <div style="text-align: center">
                        <a type="submit" class="site-btn " style="color: #fff" href="{{url('/')}}">
                            <span class="loadActive" role="status" aria-hidden="true"></span>
                            Ok
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
