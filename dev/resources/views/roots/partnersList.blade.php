@extends('template.rootTemplate')
@section('title')
Partenaires - Liste  | Administration NDD
@endsection
@section('content')
<!-- Content wrapper -->

 
          <div class="content-wrapper">
            <!-- Content -->
            
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages /</span> Liste des Partenaires </h4>

               <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Liste des partenaires</h4>
                            <button class="btn btn-danger btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
                                <i class="bx bx-plus"></i>
                               Ajouter un partenaire
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                           <!-- Modal add speaker-->
        <div class="modal fade"  tabindex="-1" id="addRowModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content addC">
                <form id="storePartner" data-url="{{ route('store-partner') }}">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                        Ajout des partenaires </span> 
                        <span class="fw-light">
                          
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
                    <p class="small">Section permettant d'ajouter les partenaires</p>
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
                                    <span class="d-none d-sm-block">Logo du Partenaire</span>
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
                            <hr class="my-0" />
                            <div class="col-sm-12 my-3">
                                <div class="form-group form-group-default">
                                    <label class="col-form-label">Nom Partenaire</label>
                                    <input class="form-control" id="name" name="name" type="text" required>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="form-group form-group-default">
                                   <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                 <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required name="description"></textarea>
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
                                        <th>Logo</th>
                                        <th>Nom Partenaire </th>
                                        <th>Description</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                   @foreach($partners as $partner)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td> 
                                            <div class="text-center">
                                                <img src="{{asset('storage/partners/'.$partner->cover)}}" alt="..." 
                                                    class="d-block rounded"
                                                    height="100"
                                                    width="100" >
                                            </div>
                                        </td>
                                        <td >{{$partner->name}}</td>
                                        <td>{{$partner->description}}</td>
                                        
                                        <td>

                                            <div class="form-button-action">
                                                <button data-bs-toggle="modal"
                                                    class="btn btn-icon btn-info btn-sm"
                                                    data-bs-target="#updatePartner{{$i}}"
                                                     title="Modifier" 
                                                     >
                                                    <i class="tf-icons bx bx-edit"></i>
                                                </button>
                                                <a href="{{route('delete-partner',encodeId($partner->id))}}" title="Supprimer" class="btn btn-icon btn-danger btn-sm deleteBtn" data-original-title="Supprimer" >
                                                    <i class="tf-icons bx bx-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                                                 <!--- modal member update-->
         <div class="modal fade" id="updatePartner{{$i}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content addComp">
                                    <form id="storePartner-{{$i}}" data-id="{{$i}}" data-url="{{route('store-partner')}}" class="updateForm">
                                        <input type="hidden" value="{{$partner->id}}" name="id"/>
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            Modification</span> 
                                            <span class="fw-light">
                                                du partenaire
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
                                        <p class="small">Section permettant de modifier un partenaire</p>
                                           <div class="">
                                            <div class="row">
                                               <div class="card-body">
                                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                    <img
                                                    src="{{asset('storage/partners/'.$partner->cover)}}"
                                                    alt="user-avatar"
                                                    class="d-block rounded imgUpload"
                                                    height="100"
                                                    width="100"
                                                    id="uploadedAvatar-{{$i}}"
                                                    data-id="{{$i}}"
                                                    />
                                                    <div class="button-wrapper">
                                                    <label for="upload{{$i}}" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                        <span class="d-none d-sm-block">Logo</span>
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
                                                            <label class="col-form-label">Nom Partenaire</label>
                                                            <input class="form-control" id="name" name="name" value="{{$partner->name}}" type="text" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 mb-3">
                                                        <div class="form-group form-group-default">
                                                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required name="description">{{$partner->description}}</textarea>
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
<!-- Page JS -->
    <script src="{{asset('roots/assets/js/ui-toasts.js')}}"></script>
    <script src="{{asset('roots/assets/js/pages-account-settings-account.js')}}"></script>
 
@endsection