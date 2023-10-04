@extends('template.rootTemplate')
@section('title')
Évènements - Listes  | Administration NDD
@endsection
@section('content')
<!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages /</span> Listes des évènements</h4>

               <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Évènements</h4>
                            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
                                <i class="bx bx-plus"></i>
                               Ajouter un évènement
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content addComp">
                                    <form id="storeEvent" data-url="{{route('store-event')}}">
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            Nouveau</span> 
                                            <span class="fw-light">
                                                évènement
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
                                        <p class="small">Section permettant d'ajouter des évènements</p>
                                           <div class="">
                                            <div class="row">
                                               <div class="card-body">
                                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                    <img
                                                    src="{{asset('roots/assets/img/elements/12.jpg')}}"
                                                    alt="user-avatar"
                                                    class="d-block rounded"
                                                    height="100"
                                                    width="100"
                                                    id="uploadedAvatar"
                                                    />
                                                    <div class="button-wrapper">
                                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                        <span class="d-none d-sm-block">Couverture de l'évènement</span>
                                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                                        <input
                                                        type="file"
                                                        id="upload"
                                                        class="account-file-input"
                                                        hidden
                                                        accept="image/png, image/jpeg"
                                                        name="eventCover"
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
                                                <hr class="my-0" />
                                                <div class="col-sm-12 pt-3 mb-3">
                                                    <div class="form-group form-group-default">
                                                        <label for="topic"  class="form-label">Thème du évènement</label>
                                                        <input id="subject" type="text" class="form-control" name="subject" id="topic" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-3">
                                                    <div class="form-group form-group-default">
                                                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required name="description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6  mb-3">
                                                    <div class="form-group form-group-default">
                                                        <label for="html5-date-input"  class="form-label">Date Debut</label>
                                                        <input class="form-control" type="date" value="2023-06-18" id="html5-date-input" name="date_deb"/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6  mb-3">
                                                    <div class="form-group form-group-default">
                                                        <label for="html6-date-input"  class="form-label">Date fin</label>
                                                        <input class="form-control" type="date" value="2023-06-18" id="html6-date-input" name="date_fin"/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-3">
                                                <label for="defaultInput" class="form-label">Adresse de l'évènement</label>
                                                 <div class="input-group input-group-merge">
                                                    <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-map"></i></span>
                                                    <input id="defaultInput" class="form-control" type="text" placeholder="Adresse" name="location" />
                                                </div>
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
                                        <th>Thème</th>
                                        <th>Description</th>
                                        <th>Date debut</th>
                                        <th>Date fin</th>
                                        <th>Couverture</th>
                                        <th>Programme</th>
                                        <th>Champ Gallery</th>
                                        <th>État</th>

                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                @php
                                    $i = 1;
                                    $img='addImg';
                                @endphp
                                   @foreach($events as $event)
                                    @php
                                   $calendar = \App\Http\Controllers\RootController::getCalendarByIdEvent($event->idEvent);
                                   $gallery = \App\Http\Controllers\RootController::getGalleryByIdEvent($event->idEvent);
                                    $id = $event->idEvent;

                                    @endphp
                                    <tr>
                                        <td>{{$event->eventTitle}}</td>
                                        <td >{{$event->description}}</td>
                                        <td>{{$event->start}}</td>
                                        <td>{{$event->end}}</td>
                                        <td> 
                                            <div class="text-center">
                                                <img src="{{asset('storage/events/'.$event->eventCover)}}" alt="..." 
                                                    class="d-block rounded"
                                                    height="100"
                                                    width="100" >
                                            </div>
                                        </td>
                                        <td>
                                            @if($calendar != null)
                                            <a class="btn rounded-pill btn-outline-info" title="Voir le programme" href="{{route('event-calendar-list',encodeId($id))}}">
                                                <i class="bx bx-calendar "></i>
                                            </a>
                                            @else
                                            <button class="btn btn-outline-warning rounded-pill" title="Ajouter le programme" data-bs-toggle="modal" data-bs-target="#addCalendar{{$i}}">
                                                <i class="bx bx-plus"></i>
                                            </button> 
                                            @endif  
                                        </td>
                                         <td>
                                            @if($gallery != null)
                                            <a class="btn rounded-pill btn-outline-info" title="Voir la galerie" href="{{route('event-gallery-list',encodeId($id))}}">
                                                <i class="bx bx-image "></i>
                                            </a>
                                            @else
                                            <button class="btn btn-outline-warning rounded-pill" title="Ajouter une photo" data-bs-toggle="modal" data-bs-target="#addGallery{{$i}}">
                                                <i class="bx bx-image-add"></i>
                                            </button> 
                                            @endif  
                                        </td>
                                        <td>
                                            @if($event->isEnable == true)
                                             <span class="badge rounded-pill bg-label-success">En cours</span>
                                     <!--concours Terminé-->
                                             @else
                                             <span class="badge rounded-pill bg-label-danger">Passé</span>
                                             @endif    
                                        </td>
                                        <td>

                                            <div class="form-button-action">
                                                <button data-bs-toggle="modal"
                                                    class="btn btn-icon btn-info btn-sm"
                                                     title="Modifier"
                                                     data-bs-target="#updateEvent{{$i}}" 
                                                     >
                                                    <i class="tf-icons bx bx-edit"></i>
                                                </button>
                                                <a href="{{route('delete-event',$event->idEvent)}}" title="Supprimer" class="btn btn-icon btn-danger btn-sm" data-original-title="Supprimer">
                                                    <i class="tf-icons bx bx-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
    <div class="modal fade" id="addCalendar{{$i}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <form id="storeEventCalendar"   data-url="{{route('store-event-calendar') }}">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                        Ajout de l'agenda</span> 
                        <span class="fw-light">
                            évènement 
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
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Sous thème</label>
                                    <input class="form-control" id="activity" name="activity" type="text" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                <label for="html7-date-input"  class="form-label">Date</label>
                                <input class="form-control" type="date" placeholder="2021-06-18" id="html7-date-input" name="day"/>
                                </div>
                            </div>
                          
                        </div>
                       </div>
                       <div class="modal-footer no-bd">
                        <button type="submit" id="addRowButton" class="btn btn-success " >
                            
                            Ajouter
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    </div>
                    </form>
                </div>

                
            
            </div> 
            
        </div>

        <!--- modal event update-->
         <div class="modal fade" id="updateEvent{{$i}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content addComp">
                                    <form id="storeEvent-{{$i}}" data-id="{{$i}}" data-url="{{route('store-event')}}" class="form">
                                        <input type="hidden" value="{{$event->idEvent}}" name="idEvent"/>
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            Modification</span> 
                                            <span class="fw-light">
                                                de l'évènement
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
                                        <p class="small">Section permettant de modifier un évènement</p>
                                           <div class="">
                                            <div class="row">
                                               <div class="card-body">
                                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                    <img
                                                    src="{{asset('storage/events/'.$event->eventCover)}}"
                                                    alt="user-avatar"
                                                    class="d-block rounded imgUpload"
                                                    height="100"
                                                    width="100"
                                                    id="uploadedAvatar-{{$i}}"
                                                    data-id="{{$i}}"
                                                    />
                                                    <div class="button-wrapper">
                                                    <label for="upload{{$i}}" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                        <span class="d-none d-sm-block">Couverture de l'évènement</span>
                                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                                        <input
                                                        type="file"
                                                        id="upload{{$i}}"
                                                        class="account-file-input"
                                                        hidden
                                                        accept="image/png, image/jpeg"
                                                        name="eventCover"
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
                                                <div class="col-sm-12 pt-3 mb-3">
                                                    <div class="form-group form-group-default">
                                                        <label for="topic"  class="form-label">Thème du évènement</label>
                                                        <input id="subject" type="text" class="form-control" name="subject" value="{{$event->eventTitle}}" id="topic" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-3">
                                                    <div class="form-group form-group-default">
                                                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required name="description">{{$event->description}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6  mb-3">
                                                    <div class="form-group form-group-default">
                                                        <label for="html5-date-input"  class="form-label">Date Debut</label>
                                                        <input class="form-control" type="date"  id="html5-date-input" value="{{$event->start}}" name="date_deb"/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6  mb-3">
                                                    <div class="form-group form-group-default">
                                                        <label for="html6-date-input"  class="form-label">Date fin</label>
                                                        <input class="form-control" type="date" value="{{$event->end}}" id="html6-date-input" name="date_fin"/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-3">
                                                <label for="defaultInput" class="form-label">Adresse de l'évènement</label>
                                                 <div class="input-group input-group-merge">
                                                    <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-map"></i></span>
                                                    <input id="defaultInput" class="form-control" type="text" placeholder="Adresse" value="{{$event->location}}" name="location" />
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
                        <!-- Modal add Gallery-->

                         <div class="modal fade" id="addGallery{{$i}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content ">
                                        <form id="storeEventGallery-{{$i}}" data-id="{{$i}}" class="addGalleryForm" data-url="{{route('store-event-gallery') }}">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                Ajout d'image </span> 
                                                <span class="fw-light">
                                                    d'évènement 
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
                                            <p class="small">Section permettant d'établir la gallery</p>
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
                                                        id="uploadedAvatar-{{$i}}{{$img}}"
                                                        data-id="{{$i}}{{$img}}"
                                                        />
                                                        <div class="button-wrapper">
                                                            <label for="upload{{$i}}{{$img}}" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                            <span class="d-none d-sm-block">Image</span>
                                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                                            <input
                                                            type="file"
                                                            id="upload{{$i}}{{$img}}"
                                                            class="account-file-input"
                                                            hidden
                                                            accept="image/png, image/jpeg"
                                                            name="cover"
                                                            />
                                                            </label>
                                                            <button type="button" class="btn btn-outline-secondary account-image-reset{{$i}}{{$img}} mb-4">
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
                                                <button type="submit" id="addRowButton" class="btn btn-success " >
                                                    
                                                    Ajouter
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