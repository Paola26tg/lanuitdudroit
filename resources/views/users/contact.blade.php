@extends('template.userTemplate')
@section('title')
Contact | La nuit du Droit
@endsection
@section('content')
<!-- Contact Top Content Section Begin -->
    <section class="contact-content-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="cc-text set-bg "  data-setbg="{{asset('storage/home/'.$home->banner)}}">
                        <div class="row" >
                            <div class="col-lg-8 offset-lg-4" >
                                 <div class="section-title" >
                                    <h2 >Lieu de la conférence</h2>
                                    <p>La localisation de l'évènement</p>
                                </div>
                                <div class="cs-text">
                                    <div class="ct-address">
                                        <span>Addresse:</span>
                                        <p> {{$event->location}} Lomé, <br />TOGO</p>
                                    </div>
                                    <ul>
                                        <li>
                                            <span>Tel:</span>
                                            +228 90 97 53 39
                                        </li>
                                        <li>
                                            <span>Email:</span>
                                            lanuitdudroit-togo.com
                                        </li>
                                    </ul>
                       <!--  <div class="ct-links">
                            <span>Powered by:</span>
                            <p>BIZIYEE COORPORATION</p>
                        </div> -->
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cc-map">
                         <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15866.828963651204!2d1.2125517!3d6.1699415!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1023e20a80b804d9%3A0x1a1eb5885d6ca5a3!2sINSTITUT%20CONFUCIUS!5e0!3m2!1sfr!2stg!4v1680879754239!5m2!1sfr!2stg"
                        height="580" style="border:0;" allowfullscreen="">
                    </iframe>
                        <!-- <div class="map-hover">
                            <i class="fa fa-map-marker"></i>
                            <div class="map-hover-inner">
                                <h5>01 Pascale SP Apt. 339</h5>
                                <p>NewYork City, US</p>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Top Content Section End -->

    <!-- Contact Form Section Begin -->
    <section class="contact-from-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Contactez nous via Email!</h2>
                        <p>Remplissez le formulaire sous-dessus et recevez des réponses à vos questions</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form class="comment-form contact-form" id="contactForm">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="text" placeholder="Noms" name="nom" required>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" placeholder="Email" name="email" required>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" placeholder="Téléphone" name="tel" required>
                            </div>
                            <div class="col-lg-12 text-center">
                                <textarea placeholder="Messages" name="message"></textarea>
                                <button type="submit" class="site-btn">
                                    <span class="loadActive" role="status" aria-hidden="true"></span>
                                    Soumettre
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Form Section End -->
    @endsection

    @section('scripts')
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.9/dist/sweetalert2.all.min.js"></script>
     <script>
         $(document).ready(function() {
             $("#contactForm").submit(function(e){
                 e.preventDefault();
                 contactus();
             });
             const swalWithBootstrapButtons = Swal.mixin({
                 customClass: {
                     confirmButton: 'btn btn-success',
                     cancelButton: 'btn btn-danger'
                 },
                 buttonsStyling: false
             })
         });
         function contactus(){
             let form = $('#contactForm')[0];
             let data = new FormData(form);
             $('.loadActive').addClass('spinner-border')
             $.ajax({
                 type: 'POST',
                 url: '{{ route("contact-us") }}',
                 data: data,
                 processData: false,
                 contentType: false,
                 success:function(result) {
                     $('.loadActive').removeClass('spinner-border')
                     if(result === '1'){
                         Swal.fire({
                             title:"Opération réussie",
                             text: "Votre message a été envoyé.. Merci!!",
                             icon: "success",
                             showConfirmButton: true,
                             confirmButtonText: 'D\'accord!'
                         }).then((state) => {
                             setTimeout(function () {
                                 window.location.reload()
                             }, 500);
                         });

                     } else{
                         $('.loadActive').removeClass('spinner-border')
                         Swal.fire({
                             title:'Oops!!',
                             text: "Echec de l'opération",
                             icon: "error",
                             showCancelButton: false,
                             cancelButtonText: 'D\'accord!'
                         })
                     }

                 },

                 error:function(error){
                     $('.loadActive').removeClass('spinner-border')
                     console.log(error);
                     Swal.fire({
                         title:'Oops!!',
                         text: "Echec de l'opération",
                         icon: "error",
                         showCancelButton: false,
                         cancelButtonText:  'D\'accord!'
                     })

                 }

             })
         }
     </script>
 @endsection
