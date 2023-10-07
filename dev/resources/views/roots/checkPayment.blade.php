@extends('template.rootTemplate')
@section('title')
    Vérifier Paiement | La nuit Du Droit
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
                                <h2>Vérifiez un paiement!!</h2>
                                <p>Vérifiez si vous avez reçu un paiement avec les informations ci-dessous</p>
                            </div>
                        </div>
                    </div>
                    <form id="confirm" class="comment-form contact-form" method="POST" action="{{route('save-check-payment')}}">
                        <div class="row">
                            <input id="idAttendee" type="hidden" value="{{$attendee->id}}" name="idAttendee"/>
                            <div class="col-lg-12">
                                <label for="exampleFormControlInput1" class="form-label">Numéro ayant effectué le dépôt</label>
                                <input type="text" disabled placeholder="N° Téléphone" name="phone" value="{{$attendee->phone_transaction}}" required>
                            </div>
                            <div class="col-lg-12">
                                <label for="exampleFormControlInput1" class="form-label">Référence de la transaction</label>
                                <input type="text" disabled placeholder="N° Référence" name="reference" value="{{$attendee->reference_transaction}}" required>
                            </div>
                            <div class="col-lg-12">
                                <textarea name="comment" id="" cols="40" rows="5" placeholder="Ajouter un commentaire pour invalider la transaction"></textarea>
                                @if($errors->has('comment'))
                                    <div class="error">{{ $errors->first('comment') }}</div>
                                @endif
                            </div>
                            <div class="col-lg-12 text-center">

                                <button type="submit" class="btn btn-info" name="action" value="valid">
                                    <span class="loadActive" role="status" aria-hidden="true"></span>
                                    Valider
                                </button>

                                <button type="submit" class="btn btn-danger" name="action" value="invalid">
                                    <span class="loadActive" role="status" aria-hidden="true"></span>
                                    Invalider
                                </button>


                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
