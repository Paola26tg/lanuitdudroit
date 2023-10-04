@extends('template.rootTemplate')
@section('title')
Panélistes - Liste  | Administration NDD
@endsection
@section('content')
<!-- Content wrapper -->
 @if(Session('successMessage'))
            <div aria-live="polite" aria-atomic="true" class="position-relative">
             <div class="toast-container position-absolute top-0 end-0 p-3">

                <div
                        class="bs-toast toast toast-placement-ex {{Session('successMessage')?'show':''}}  bg-danger"
                        role="alert"
                        aria-live="assertive"
                        aria-atomic="true"
                        data-bs-delay="2000"
                      >
                        <div class="toast-header">
                          <i class="bx bx-bell me-2"></i>
                          <div class="me-auto fw-semibold">Suppression</div>
                          <small>A l'instant</small>
                          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                         {{Session('successMessage')}}
                        </div>
                      </div>
             </div>
            </div>
            @endif
 
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages /</span> Liste des Panélistes </h4>

               <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Liste des Panélistes</h4>
                        </div>
                    </div>
                    <div class="card-body">
                           <!-- Modal add speaker-->
                       

                        <div class="table-responsive">
                            <table id="add-row" class="display table" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Profile</th>
                                        <th>Noms</th>
                                        <th>Métier</th>
                                        <th>Évènement participé</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                   @foreach($speakers as $speaker)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td> 
                                            <div class="text-center">
                                                <img src="{{asset('storage/speakers/'.$speaker->cover)}}" alt="..." 
                                                    class="d-block rounded"
                                                    height="100"
                                                    width="100" >
                                            </div>
                                        </td>
                                        <td >{{$speaker->name}}</td>
                                        <td>{{$speaker->job}}</td>
                                         <td>{{$speaker->eventTitle}}</td>
                                        
                                        <td>

                                            <div class="form-button-action">
                                                <button data-bs-toggle="modal"
                                                    class="btn btn-icon btn-info btn-sm"
                                                     data-bs-target="#updateSpeaker{{$i}}"
                                                     title="Modifier" 
                                                     >
                                                    <i class="tf-icons bx bx-edit"></i>
                                                </button>
                                                <a href="{{route('delete-speaker',encodeId($speaker->idSpeaker))}}" title="Supprimer" class="btn btn-icon btn-danger btn-sm" data-original-title="Supprimer">
                                                    <i class="tf-icons bx bx-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                        <!--- modal Speaker update-->
         <div class="modal fade" id="updateSpeaker{{$i}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content addComp">
                                    <form id="storeEventCalendarSpeaker-{{$i}}" data-id="{{$i}}" data-url="{{route('store-event-calendar-speaker')}}" class="form">
                                        <input type="hidden" value="{{$speaker->idSpeaker}}" name="idSpeaker"/>
                                         <input id="idEvent" type="text" class="form-control" name="idEvent" hidden value="{{$speaker->idEvent}}">
                                         <input id="idCalendar" type="text" class="form-control" name="idCalendar" hidden value="{{$speaker->idCalendar}}">
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            Modification</span> 
                                            <span class="fw-light">
                                                du Panéliste
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
                                        <p class="small">Section permettant de modifier un panéliste</p>
                                           <div class="">
                                            <div class="row">
                                               <div class="card-body">
                                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                    <img
                                                    src="{{asset('storage/speakers/'.$speaker->cover)}}"
                                                    alt="user-avatar"
                                                    class="d-block rounded imgUpload"
                                                    height="100"
                                                    width="100"
                                                    id="uploadedAvatar-{{$i}}"
                                                    data-id="{{$i}}"
                                                    />
                                                    <div class="button-wrapper">
                                                    <label for="upload{{$i}}" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                        <span class="d-none d-sm-block">Profile du panéliste</span>
                                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                                        <input
                                                        type="file"
                                                        id="upload{{$i}}"
                                                        class="account-file-input"
                                                        hidden
                                                        accept="image/png, image/jpeg"
                                                        name="cover"
                                                       
                                                        />
                                                    </label>
                                                    <button type="button" class="btn btn-outline-secondary account-image-reset{{$i}} mb-4">
                                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Annuler</span>
                                                    </button>

                                                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                    </div>
                                                </div>
                                                </div>
                                                <hr class="my-0" />
                                                <div class="col-sm-12 my-3">
                                                <div class="form-group form-group-default">
                                                    <label class="col-form-label">Nom Complet</label>
                                                    <input class="form-control" id="name" name="name" type="text" value="{{$speaker->name}}" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <div class="form-group form-group-default">
                                                    <label class="col-form-label">Métier exercé</label>
                                                    <input class="form-control" id="job" name="job" type="text" value="{{$speaker->job}}" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                            <div class="form-group form-group-default">
                                                    <label class="col-form-label">Lien Réseau social</label>
                                                    <input class="form-control" id="social_link" name="social_link" value="{{$speaker->social_link}}" type="text" required>
                                                </div>
                                            </div>
                                             
                                            </div>
                                           </div>
                                          
                                    </div>

                                    <div class="modal-footer no-bd">
                                        <button type="submit" class="btn btn-success">
                                           
                                            Modifier
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                    </div>
                                  
                                </form>
                                </div>
                                
                                
                            </div>
                        </div>
         
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
            scrollX: true,
            scrollY: true,
        });

        var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Modifier"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Supprimer"> <i class="fa fa-times"></i> </button> </div> </td>';

    });
</script>
<!-- Page JS -->
    <script src="{{asset('roots/assets/js/pages-account-settings-account.js')}}"></script>
 
@endsection