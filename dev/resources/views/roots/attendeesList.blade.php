@extends('template.rootTemplate')
@section('title')
Participants - Liste  | Administration NDD
@endsection
@section('content')
@section('content')
<!-- Content wrapper -->

          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages /</span> Liste des Participants </h4>

               <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Liste des participants</h4>
                        </div>
                    </div>
                    <div class="card-body">


                        <div class="table-responsive">
                            <table id="add-row" class="display table" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> Évènement</th>
                                        <th>Noms</th>
                                        <th>Email</th>
                                        <th>Numéro</th>
                                        <th>Profession</th>
                                        <th>Source</th>
                                        <th>Adresse</th>
                                         <th>Tranche d'âge</th>
                                          <th>Commentaire</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                   @foreach($attendees as $attendee)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$attendee->eventTitle}}</td>
                                        <td >{{$attendee->name}}</td>
                                        <td>{{$attendee->email}}</td>
                                         <td >{{$attendee->phone}}</td>
                                        <td>{{$attendee->job}}</td>
                                         <td >{{$attendee->source}}</td>
                                        <td>{{$attendee->adresse}}</td>
                                         <td >{{$attendee->age}}</td>
                                        <td>{{$attendee->comment}}</td>

                                        <td>

                                            <div class="form-button-action">
                                                <button data-bs-toggle="tooltip modal" title="Supprimer" class="btn btn-icon btn-danger btn-sm" data-original-title="Supprimer">
                                                    <i class="tf-icons bx bx-trash"></i>
                                                </button>
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
            scrollX: true,
            scrollY: true,
        });

        var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Modifier"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Supprimer"> <i class="fa fa-times"></i> </button> </div> </td>';

    });
</script>
<!-- Page JS -->
    <script src="{{asset('roots/assets/js/pages-account-settings-account.js')}}"></script>

@endsection
