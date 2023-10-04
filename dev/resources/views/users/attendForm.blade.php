@extends('template.userTemplate')
@section('title')
Formulaire de participation | La nuit Du Droit 
@endsection
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.9/dist/sweetalert2.min.css
" rel="stylesheet">
@endSection
@section('content')
<!-- Contact Top Content Section Begin -->
    <section class="contact-content-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cc-text set-bg-form" data-setbgform="{{asset('users/img/contact-content-bg.jpg')}}" >
                        <div class="row">
                            <div class="col-lg-8 offset-lg-4">
                                <div class="section-title">
                                    <h2>Formulaire de participation</h2>
                                    <p>Inscrivez-vous dès maintenant à la conférence!! </p>
                                </div>
                            </div>
                        </div>
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
                        <h2>Inscrivez-vous!!</h2>
                        <p>Rejoignez-nous à la Conférence Jeunes Visionnaires pour embrasser l'innovation, cultiver votre vision et devenir acteur du changement positif !</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form id="attendEvent" class="comment-form contact-form">
                        <div class="row">
                              <input id="idEvent" hidden value="{{$event->idEvent}}" name="idEvent"/>
                            <div class="col-lg-6">
                                <label for="exampleFormControlInput1" class="form-label">Noms et Prénoms</label>
                                <input type="text" placeholder="Noms et Prénoms" name="name" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="exampleFormControlInput1" class="form-label">Adresse Email</label>
                                <input type="email" placeholder="Adresse Email" name="email" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="exampleFormControlInput1" class="form-label">Numéro whatsapp</label>
                                <input type="tel" placeholder="N° de téléphone" name="phone" required>
                            </div>
                             <div class="col-lg-6">
                                <label for="exampleFormControlInput1" class="form-label">Profession (veuillez préciser votre domaine ou filière)</label>
                                 <input type="text" placeholder="Profession" name="job" required>
                            </div>
                            <div class="col-lg-6">
                                 <label for="exampleFormControlInput1" class="form-label">Votre tranche d'âge</label>
                                 <select class="form-select" name="age" aria-label="Default select example">
                                    <option selected></option>
                                    <option value="16-23ans">16-23ans</option>
                                    <option value="24-30ans">24-30ans</option>
                                    <option value="31-40ans">31-40ans</option>
                                    <option value="41-50ans">41-50ans</option>
                                    <option value="51 et +">51 et +</option>
                                   
                                </select>
                            </div>
                            <div class="col-lg-6 mb-4">
                                 <label for="exampleFormControlInput1" class="form-label">Comment avez-vous appris la tenue de cette conférence?</label>
                                 <select class="form-select" name="source" aria-label="Default select example">
                                    <option selected></option>
                                    <option value="A la télé">A la télé</option>
                                    <option value="A la radio">A la radio </option>
                                    <option value="Sur Facebook">Sur Facebook</option>
                                    <option value="Sur Instagram">Sur Instagram</option>
                                    <option value="Boucche à bouche">Bouche à bouche</option>
                                    <option value="Autre à préciser">Autre à préciser</option>
                                </select>
                            </div>

                            <div class="col-lg-12">
                                 <label for="exampleFormControlInput1" class="form-label">Quelle est votre motivation à participer à cette conférence?</label>
                                 <textarea placeholder="Messages" name="comment" rows="2"  ></textarea>
                            </div>
                            <div class="col-lg-12 text-center">
                             
                                <button type="submit" class="site-btn ">
                                     <span class="loadActive" role="status" aria-hidden="true"></span>
                                    Participer
                                </button>
                            </div>
                        </div>
                         @csrf
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
$("#attendEvent").submit(function(e){
    e.preventDefault();
    attendSubmit();
  });
  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})
  });
        function attendSubmit(){
        
        
        let form = $('#attendEvent')[0];
        let data = new FormData(form);
        $('.loadActive').addClass('spinner-border')
    $.ajax({
                    type: 'POST',
                    url: '{{ route("store-attend") }}',
                    data: data,
                    processData: false,
                    contentType: false,
                    success:function(result) {
                        $('.loadActive').removeClass('spinner-border')
                        if(result === '1'){
                           Swal.fire({
                                title:"Good Job",
                                text: "Équipe enregistrée! Vous receverez un email de confirmation d'inscription.. Merci!!",
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