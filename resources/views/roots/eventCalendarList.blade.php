@extends('template.rootTemplate')
@section('title')
Calendrier - de l'évènement - Listes  | Administration NDD
@endsection
@section('content')
<!-- Content wrapper -->
 @php
    $calendar = \App\Http\Controllers\RootController::getCalendarByIdEvent($eventID) 
   @endphp
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages /</span> Programme de l'évènement du {{$event->start}}</h4>

               <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Programme de l'évènement</h4>
                            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
                                <i class="bx bx-plus"></i>
                               Ajouter un programme au calendrier
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content addComp">
                                    <form id="storeEventCalendar" data-url="{{ route('store-event-calendar') }}">
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            Nouveau</span> 
                                            <span class="fw-light">
                                                Programme
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
                                        <th>Sous Thème</th>
                                        <th>Date</th>
                                        <th>Heure</th>
                                        <th>Programme</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                   @foreach($calendars as $calendar)
                                    @php
                                   $speaker = \App\Http\Controllers\RootController::getSpeakerByIdCalendar($calendar->idCalendar);
                                    $activity = \App\Http\Controllers\RootController::getActivityByIdCalendar($calendar->idCalendar);
                                    $id = $calendar->idCalendar;
                                    
                                    @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td >{{$calendar->subtitle}}</td>
                                        <td>{{$calendar->day}}</td>
                                        <td>{{$calendar->time}}</td>
                                        <td>
                                            @if($speaker != null)
                                            <a class="btn rounded-pill btn-outline-info" title="Voir la liste des panélistes" href="{{route('event-calendar-speaker-list',encodeId($id))}}">
                                                <i class="bx bx-user-voice "></i>
                                            </a>
                                            @else
                                            <button class="btn btn-outline-warning rounded-pill" title="Ajouter un panéliste" data-bs-toggle="modal" data-bs-target="#addSpeaker{{$i}}">
                                                <i class="bx bx-user-plus"></i>
                                            </button> 
                                            @endif  
                                             @if($activity != null)
                                            <a class="btn rounded-pill btn-outline-success" title="Voir la liste des activités" href="{{route('event-calendar-activity-list',encodeId($id))}}">
                                                <i class="bx bx-list-ul "></i>
                                            </a>
                                            @else
                                            <button class="btn btn-outline-secondary rounded-pill" title="Ajouter une activité" data-bs-toggle="modal" data-bs-target="#addActivity{{$i}}">
                                                <i class="bx bx-list-plus"></i>
                                            </button> 
                                            @endif  
                                        </td>
                                        
                                        <td>

                                            <div class="form-button-action">
                                                <button data-bs-toggle="modal"
                                                 class="btn btn-icon btn-info btn-sm"
                                                    data-bs-target = "#updateEventCalendar{{$i}}"
                                                     title="Modifier" 
                                                     >
                                                    <i class="tf-icons bx bx-edit"></i>
                                                </button>
                                                <a  href="{{route('delete-calendar',encodeId($calendar->idCalendar))}}" title="Supprimer" class="btn btn-icon btn-danger btn-sm" data-original-title="Supprimer">
                                                    <i class="tf-icons bx bx-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>


        <!-- Modal update calendar-->
         <div class="modal fade" id="updateEventCalendar{{$i}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content addComp">
                                    <form id="storeEventCalendar-{{$i}}" data-id="{{$i}}" class="form" data-url="{{route('store-event-calendar') }}">
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            Modifier</span> 
                                            <span class="fw-light">
                                                Le Programme
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
                                    <p class="small">Section permettant de modifier le calendrier</p>
                                    <div class="row">
                                        <input id="idEvent" type="text" class="form-control" name="idEvent" hidden value="{{$event->idEvent}}">
                                         <input id="idCalendar" type="text" class="form-control" name="idCalendar" hidden value="{{$calendar->idCalendar}}">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Sous thème</label>
                                                    <input class="form-control" id="activity" value="{{$calendar->subtitle}}" name="activity" type="text" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                <label for="html8-date-input"  class="form-label">Date</label>
                                                <input class="form-control" type="date" value="{{$calendar->day}}" id="html8-date-input" name="day"/>
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

            <!-- Modal add speaker-->
        
        <div class="modal fade" id="addSpeaker{{$i}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content addC">
                <form id="storeEventCalendarSpeaker"  data-url="{{ route('store-event-calendar-speaker') }}">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                        Ajout de panéliste</span> 
                        <span class="fw-light">
                           au calendrier
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
                    <p class="small">Section permettant d'ajouter les panélistes</p>
                       <div class="row">
                        <input id="idEvent" type="text" class="form-control" name="idEvent" hidden value="{{$event->idEvent}}">
                        <input id="idCalendar" type="text" class="form-control" name="idCalendar" hidden value="{{$calendar->idCalendar}}">
                         <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img
                                src="{{asset('roots/assets/img/elements/12.jpg')}}"
                                alt="user-avatar"
                                class="d-block rounded imgUpload"
                                height="100"
                                width="100"
                                id="uploadedAvatar-{{$i}}"
                                data-id="{{$i}}"
                                />
                                <div class="button-wrapper">
                                    <label for="upload{{$i}}" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Photo du Panéliste</span>
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
                                    <input class="form-control" id="name" name="name" type="text" required>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="form-group form-group-default">
                                    <label class="col-form-label">Métier exercé</label>
                                    <input class="form-control" id="job" name="job" type="text" required>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                               <div class="form-group form-group-default">
                                    <label class="col-form-label">Lien Réseau social</label>
                                    <input class="form-control" id="social_link" name="social_link" type="text" required>
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

  <!-- Modal add activity-->
     <div class="modal fade" id="addActivity{{$i}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content addC">
                <form id="storeEventCalendarActivity"  data-url="{{ route('store-event-calendar-activity') }}">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                        Ajout d'activité</span> 
                        <span class="fw-light">
                           au calendrier
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
                    <p class="small">Section permettant d'ajouter les activités</p>
                       <div class="row">
                        <input id="idEvent" type="text" class="form-control" name="idEvent" hidden value="{{$event->idEvent}}">
                        <input id="idCalendar" type="text" class="form-control" name="idCalendar" hidden value="{{$calendar->idCalendar}}">
                         
                            <hr class="my-0" />
                            <div class="col-sm-12 my-3">
                                <div class="form-group form-group-default">
                                    <label class="col-form-label">Activité</label>
                                    <input class="form-control" id="name" name="name" type="text" required>
                                </div>
                            </div>
                              <div class="col-sm-6">
                                <label for="html5-time-input" class="col-md-6 col-form-label">Heure debut</label>
                                <div class="col-md-10">
                                <input class="form-control" type="time" placeholder="12:30:00" id="html5-time-input" name="time_s" />
                                </div>
                            </div>
                             <div class="col-sm-6">
                                 <label for="html6-time-input" class="col-md-6 col-form-label">Heure fin</label>
                                <div class="col-md-10">
                                <input class="form-control" type="time" placeholder="12:30:00" id="html6-time-input" name="time_e" />
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
        const file = $('#upload');
        var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Modifier"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Supprimer"> <i class="fa fa-times"></i> </button> </div> </td>';
       console.log(file);
    });
</script>
<!-- Page JS -->
    <script src="{{asset('roots/assets/js/pages-account-settings-account.js')}}"></script>
 
@endsection