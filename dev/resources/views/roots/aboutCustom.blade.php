@extends('template.rootTemplate')
@section('title')
A propos - Paramètres  | Administration 
@endsection
@section('content')
<!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Paramètres générales /</span> A propos</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link " href="{{route('home-custom')}}"><i class="bx bx-home me-1"></i> Accueil</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="#"
                        ><i class="bx bx-message-rounded-dots me-1"></i> A propos NDD</a
                      >
                    
                  </ul>
                  <div class="card mb-4">
                     
                    <div class="card-body">
                      <form id="formHome" method="POST" onsubmit="return false">
                        <div class="row">
                          <div class="mb-3 col-md-12">
                            @if(empty($home))
                           <img class="card-img-top" 
                           src="{{asset('roots/assets/img/default-banner.png')}}"  id="uploadedAvatar" alt="Card image cap"
                           width="500"
                           height="500"
                           />
                           @else
                            <img class="card-img-top" 
                           src="{{asset('storage/home/'.$home->aboutCover)}}"  id="uploadedAvatar" alt="Card image cap"
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
                                name="aboutCover"
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
                          
                          <div class="mb-3 col-md-12">
                             <label for="exampleFormControlTextarea1" class="form-label">Description briève </label>
                             @if(!empty($home))
                                <textarea class="form-control" id="summernote" name="about" rows="3">{{$home->about}}</textarea>
                                @else
                                <textarea class="form-control" id="summernote" name="about" rows="3"></textarea>
                                @endif
                          </div>
                          <div class="mb-3 col-md-12">
                             <label for="exampleFormControlTextarea1" class="form-label"> Notre histoire</label>
                             @if(!empty($home))
                                <textarea class="form-control" id="summernote2" name="description" rows="3">{{$home->description}}</textarea>
                                @else
                                 <textarea class="form-control" id="summernote2" name="description" rows="3">l'histoire de NDD</textarea>
                                 @endif
                          </div>
                          
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Modifier</button>
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
  <script>
    $(document).ready(function() {
  $('#summernote').summernote();
  $('#summernote2').summernote();
});
</script>  

@endsection