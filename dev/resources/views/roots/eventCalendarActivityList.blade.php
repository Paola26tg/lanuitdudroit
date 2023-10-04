@extends('template.rootTemplate')
@section('title')
Activités du programme - Listes  | Administration NDD
@endsection
@section('content')
<!-- Content wrapper -->
 
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages /</span> Liste des activités du programme du  {{$calendar->day}}</h4>

               <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Liste des activités</h4>
                            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
                                <i class="bx bx-plus"></i>
                               Ajouter une activité
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                           <!-- Modal add activity-->
        <div class="modal fade"  tabindex="-1" id="addRowModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content addC">
                <form id="storeEventCalendarActivity" data-url="{{ route('store-event-calendar-activity') }}">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                        Ajout une activité </span> 
                        <span class="fw-light">
                           au programme
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
                        <input id="idEvent" type="text" class="form-control" name="idEvent" hidden value="{{$calendar->idEvent}}">
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
                       

                        <div class="table-responsive">
                            <table id="add-row" class="display table" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Activité </th>
                                        <th>Période</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                @php
                                    $i = 1;
                                @endphp

                                   @foreach($activities as $activity)
                                   @php
                                   $time = explode('-', $activity->time);
                                   @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        
                                        <td >{{$activity->activity}}</td>
                                        <td>{{$activity->time}}</td>
                                       
                                        
                                        <td>

                                            <div class="form-button-action">
                                                <button data-bs-toggle="modal"
                                                    class="btn btn-icon btn-info btn-sm"
                                                    data-bs-target="#updateActivity{{$i}}"
                                                     title="Modifier" 
                                                     >
                                                    <i class="tf-icons bx bx-edit"></i>
                                                </button>
                                                <a href="{{route('delete-activity',encodeId($activity->idActivity))}}" title="Supprimer" class="btn btn-icon btn-danger btn-sm" data-original-title="Supprimer">
                                                    <i class="tf-icons bx bx-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                                                 <!--- modal activity update-->
         <div class="modal fade" id="updateActivity{{$i}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content addComp">
                                    <form id="storeEventCalendarActivity-{{$i}}" data-id="{{$i}}" data-url="{{route('store-event-calendar-activity')}}" class="form">
                                        <input type="hidden" value="{{$activity->idActivity}}" name="idActivity"/>
                                         <input id="idEvent" type="text" class="form-control" name="idEvent" hidden value="{{$activity->idEvent}}">
                                         <input id="idCalendar" type="text" class="form-control" name="idCalendar" hidden value="{{$activity->idCalendar}}">
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            Modification</span> 
                                            <span class="fw-light">
                                                de l'activité
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
                                        <p class="small">Section permettant de modifier un activité</p>
                                           <div class="">
                                            <div class="row">
                                    
                                                <hr class="my-0" />
                                                <div class="col-sm-12 my-3">
                                                <div class="form-group form-group-default">
                                                    <label class="col-form-label">Activité</label>
                                                    <input class="form-control" id="name" name="name" type="text" value="{{$activity->activity}}" required>
                                                </div>
                                            </div>
                                             <div class="col-sm-6">
                                                <label for="html5-time-input" class="col-md-6 col-form-label">Heure debut</label>
                                                <div class="col-md-10">
                                                <input class="form-control" type="time" value={{$time[0]}} id="html5-time-input" name="time_s" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="html6-time-input" class="col-md-6 col-form-label">Heure fin</label>
                                                <div class="col-md-10">
                                                <input class="form-control" type="time" value={{$time[1]}} id="html6-time-input" name="time_e" />
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
        });

        var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Modifier"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Supprimer"> <i class="fa fa-times"></i> </button> </div> </td>';

    });
</script>
<!-- Page JS -->
    <script src="{{asset('roots/assets/js/pages-account-settings-account.js')}}"></script>
 
@endsection