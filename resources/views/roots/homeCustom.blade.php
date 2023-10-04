@extends('template.rootTemplate')
@section('title')
Accueil - Paramètres  | Administration NDD
@endsection
@section('content')
<!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Paramètres générales /</span> Page d'Acceuil</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-home me-1"></i> Accueil</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('about-custom')}}"
                        ><i class="bx bx-message-rounded-dots me-1"></i> A propos NDD</a
                      >
                    
                  </ul>
                  <div class="card mb-4">
                     
                    <div class="card-body">
                      <form id="formHome" >
                        <div class="row">
                          <div class="mb-3 col-md-12">
                            @if(empty($home))
                             <img class="card-img-top" 
                           src="{{asset('roots/assets/img/default-banner.png')}}"  id="uploadedAvatar" alt="Card image cap"
                           width="500"
                           height="500"
                           />
                           @elseif(!empty($home))
                           <img class="card-img-top" 
                           src="{{asset('storage/home/'.$home->banner)}}"  id="uploadedAvatar" alt="Card image cap"
                           width="500"
                           height="500"
                           />
                           @endif
                    <!-- Account -->
                        <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Modifier la bannière</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input
                                type="file"
                                id="upload"
                                class="account-file-input"
                                hidden
                                accept="image/png, image/jpeg"
                                name="banner"
                               
                                />
                            </label>
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>

                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="title" class="form-label">Mot d'accroche </label>
                            @if(!empty($home))
                            <input class="form-control" type="text" name="title" id="title" value="{{$home->title}}" required/>
                           @else
                           <input class="form-control" type="text" name="title" id="title" value="Mot d'accroche" required/>
                           @endif
                          </div>
                          
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Enregistrer</button>
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                 
                </div>
              </div>
            </div>
            <!-- / Content -->
@endsection
@section('scripts')
 <!-- Page JS -->
    <script src="{{asset('roots/assets/js/pages-account-settings-account.js')}}"></script>
   

@endsection