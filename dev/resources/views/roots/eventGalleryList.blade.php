@extends('template.rootTemplate')
@section('title')
Galerie - de l'évènement - Listes  | Administration NDD
@endsection
@section('content')
<!-- Content wrapper -->
 @php
    $gallery = \App\Http\Controllers\RootController::getGalleryByIdEvent($eventID) 
   @endphp
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages /</span> Les images  de l'évènement du {{$event->start}}</h4>

               <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Images de l'évènement</h4>
                            <button class="btn btn-danger btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
                                <i class="bx bx-plus"></i>
                               Ajouter un nouveau image à  la galerie
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content addComp">
                                    <form id="storeEventGallery" data-url="{{ route('store-event-gallery') }}">
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            Nouveau</span> 
                                            <span class="fw-light">
                                                image
                                            </span>
                                        </h5>
                                       <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                        ></button>
                                           
                                    </div>
                                    <div class="modal-body">
                                    <p class="small">Section permettant d'établir le calendrier</p>
                                    <div class="row">
                                        <input id="idEvent" type="text" class="form-control" name="idEvent" hidden value="{{$event->idEvent}}">
                                         <div class="card-body">
                                                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                        <img
                                                        src="{{asset('roots/assets/img/elements/12.jpg')}}"
                                                        alt="user-avatar"
                                                        class="d-block rounded imgUpload"
                                                        height="100"
                                                        width="100"
                                                        id="uploadedAvatar"
                                                        
                                                        />
                                                        <div class="button-wrapper">
                                                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                            <span class="d-none d-sm-block">Image</span>
                                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                                            <input
                                                            type="file"
                                                            id="upload"
                                                            class="account-file-input"
                                                            hidden
                                                            accept="image/png, image/jpeg"
                                                            name="cover"
                                                            />
                                                            </label>
                                                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                                                <i class="bx bx-reset d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Annuler</span>
                                                            </button>

                                                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                            
                                        
                                                         <div class="col-sm-12 mb-3">
                                                        <div class="form-group form-group-default">
                                                            <label>Description du gallery</label>
                                                            <textarea class="form-control" id="descriptionGallery" name="description" type="text" required> </textarea>
                                                        </div>
                                                    </div>
                                                    
                                           
                                          
                                          
                                        </div>
                                    </div>

                                    <div class="modal-footer no-bd">
                                        <button type="submit" class="btn btn-success">
                                           
                                            Ajouter
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                    </div>
                                  
                                </form>
                                </div>
                                
                                
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="add-row" class="display table" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                   @foreach($galleries as $gallery)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td> 
                                            <div class="text-center">
                                                <img src="{{asset('storage/galleries/'.$gallery->cover)}}" alt="..." 
                                                    class="d-block rounded"
                                                    height="100"
                                                    width="100" >
                                            </div>
                                        </td>
                                         <td >{{$gallery->description}}</td>
                                        <td>

                                            <div class="form-button-action">
                                                <a href="{{route('delete-gallery',encodeId($gallery->idGallery))}}" title="Supprimer" class="btn btn-icon btn-danger btn-sm" data-original-title="Supprimer">
                                                    <i class="tf-icons bx bx-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
         
                                    @php
                                    $i++;
                                    @endphp

                                    @php
                                    endforeach;
                                    @endphp
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- / Content -->
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
 // Add Row
        $('#add-row').DataTable({
            "pageLength": 5,
        });
        const file = $('#upload');
        var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Modifier"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Supprimer"> <i class="fa fa-times"></i> </button> </div> </td>';
       console.log(file);
    });
</script>
<!-- Page JS -->
    <script src="{{asset('roots/assets/js/pages-account-settings-account.js')}}"></script>
 
@endsection