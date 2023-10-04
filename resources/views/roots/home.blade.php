@extends('template.rootTemplate')
@section('title')
Tableau de bord  | Administration NDD
@endsection
@section('content')
  <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 ">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Bienvenue  🎉</h5>
                          <p class="mb-4">
                            Ce tableau de bord vous permet d'avoir une vue d'enemble de tout vos activités et des évènements.
                          </p>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="{{asset('roots/assets/img/illustrations/man-with-laptop-light.png')}}"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-4 mb-4">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                              <div class="card-title">
                                <h5 class="text-nowrap mb-2"> {{empty($currentEvent)?'Aucun évènement En vue':'Évènement en cours '}}</h5>
                                <span class="badge bg-label-warning rounded-pill">Période</span>
                              </div>
                            </br>
                              <div class="mt-sm-auto">
                                Du <span class="badge bg-label-success rounded-pill">  {{empty($currentEvent)?'':$currentEvent->start}} </span> Au <span class="badge bg-label-success rounded-pill">
                                  {{empty($currentEvent)?'':$currentEvent->end}} </span>
                              </div>
                              
                            </div>
                           
                          </div>
                        </div>
                      </div>
                      </div>
                       <div class="col-lg-12 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                              <div class="card-title">
                                <h5 class="text-nowrap mb-2">Nombre d'évènements passés</h5>
                                </br>
                                <div style="text-align: center;">
                                <span class="badge bg-label-info rounded-pill"><h3>  {{empty($totalPassEvents)?'00':$totalPassEvents}}  </h3></span>
                                </br></br>
                                </div>
                              </div>
                            
                              
                            </div>
                           
                          </div>
                        </div>
                      </div>
                      </div>
                  </div>
                </div>
                    <!-- chart to see attendees per event-->
                  <div class="col-md-8 col-lg-8  mb-4">
                  <div class="card h-100">
                    <div class="card-header">
                     <h5>Nombres de participants par evènement</h5>
                    </div>
                    <div class="card-body px-0">
                      <div class="tab-content p-0">
                        <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                          <div class="d-flex p-4 pt-3">
                            <div class="avatar flex-shrink-0 me-3">
                              <img src="{{asset('roots/assets/img/icons/unicons/chart-success.png')}}" alt="User" />
                            </div>
                            <div>
                              <small class="text-muted d-block">Participants par évènement au cours de l'année</small>
                            </div>
                          </div>
                          <div id="incomeChart"></div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                 {{-- @if($newAttendees !== null)--}}
                {{-- <div class="col-lg-12 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                              <div class="card-title">
                                <h5 class="text-nowrap mb-2">Nouveaux participants inscrits pour cette semaine</h5>
                              </div>
                            </br>
                              <div class="table-responsive text-nowrap">
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Numéro de Téléphone</th>
                        <th>Profession</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                       @foreach($newAttendees as $newAttendee)
                      <tr>
                        <td> <span class="badge bg-label-danger me-1"> <i class="bx bx-user"></i></span> </td>
                         <td>{{$newAttendee->name}}</td> 
                        <td>
                           {{$newAttendee->phone}} 
                        </td>
                        <td><span class="badge bg-label-success me-1">
                          {{$newAttendee->phone}}
                        </span></td>
                        <td>
                         {{$newAttendee->job}} 
                        </td>
                        <td>
                         <div class="form-button-action">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-eye"></i>
                            </button>
                            
                         </div>
                        </td>
                      </tr>
                        @endforeach  
                    </tbody>
                  </table>
                </div>
                           
                          </div>
                        </div>
                      </div>
                    </div>
                </div> --}}
                    {{-- @endif --}} 
                <!-- Total Revenue -->
                 <div class="col-lg-12">
                    <div class="card">
                <h5 class="card-header">Les partipants inscrits </h5>
                <div class="table-responsive text-nowrap">
                  <table id="add-row" class="display table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Noms</th>
                        <th>Email</th>
                         <th>Numéro</th>
                        <th>Profession</th>
                        <th>Source</th>
                        <th>Adresse</th>
                        <th>Tranche d'âge</th>
                        <th>Commentaire</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                     
                    {{--   @php
                                    $i = 1;
                                @endphp
                                    @foreach($recentAttendees as $recentAttendee) 
                                    <tr>
                                        <td>
                                           {{$i}}</td> 
                                        <td>   {{$recentAttendee->name}}   </td>
                                        <td> {{$recentAttendee->email}}  </td>
                                         <td>  {{$recentAttendee->phone}}  </td>
                                        <td> {{$recentAttendee->job}}  </td>
                                         <td> {{$recentAttendee->source}}  </td>
                                        <td>   {{$recentAttendee->adresse}} </td>
                                         <td>  {{$recentAttendee->age}}  </td>
                                        <td> {{$recentAttendee->comment}}  </td>
                                        
                                        <td>

                                            <div class="form-button-action">
                                                <button data-bs-toggle="tooltip modal" title="Supprimer" class="btn btn-icon btn-danger btn-sm" data-original-title="Supprimer">
                                                    <i class="tf-icons bx bx-trash"></i>
                                                </button>
                                                <button data-bs-toggle="tooltip modal" title="Envoyer un mail" class="btn btn-icon btn-warning btn-sm" data-original-title="Envoyer un mail">
                                                    <i class="tf-icons bx bx-envelope"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
         
                                    @php
                                    $i++;
                                    @endphp

                                    @php
                                     endforeach;
                                    @endphp --}}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                <!--/ Total Revenue -->
                
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
@endsection