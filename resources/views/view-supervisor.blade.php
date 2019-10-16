@extends('template')

@section('title')
View supervisor
@endsection

@section('mainContent')
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('index')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">View-supervisor</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
          <div class="card-header">
            <i class="fas fa-list-ul"></i>
            Supervisor table

            <div class="float-right">
              <a href="{{route('addSupervisor')}}" class="btn btn-outline-success"><i class="fas fa-plus-circle"></i></a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>View/Edit/Delete</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($supervisors as $supervisor)
                  <tr>
                    <td>{{$supervisor['user_id']}}</td>
                    <td>{{$supervisor['name']}}</td>
                    <td>
                            <a href="#viewEmp{{$supervisor['id']}}" class="p-2 text-primary" data-toggle="modal" ><i class="fas fa-eye"></i></a>
                            <a href="#editEmp{{$supervisor['id']}}" class="p-2 text-warning" data-toggle="modal" ><i class="fas fa-edit"></i></a>
                            <a href="#deleteEmp{{$supervisor['id']}}" class="p-2 text-danger" data-toggle="modal" ><i class="fas fa-trash-alt"></i></a>

                            <!-- view Modal start -->
                            <div class="modal fade" id="viewEmp{{$supervisor['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title text-primary"  id="exampleModalLabel"><i class="fas fa-eye"></i></i> View Informations</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <center><h1 class="display-3"><i class="far fa-user"></i></h1></center>
                                      <div class="form-group">
                                        <h4>{{$supervisor['name']}}</h4>
                                        <p >Supervisor Id: {{$supervisor['user_id']}}</p>
                                        <p >User Type: {{$supervisor['user_type']}}</p>
                                        <p >Email: {{$supervisor['email']}}</p>
                                        <!-- <p >Zone: </p> -->
                                      </div>
                                      <div class="float-right">
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Ok</button>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- view Modal end -->
                            <!-- Edit Modal start -->
                            <div class="modal fade" id="editEmp{{$supervisor['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title text-warning"  id="exampleModalLabel"><i class="fas fa-edit"></i> Edit Informations</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form class="form-sample" action="{{route('updateSupervisor', $supervisor['id'])}}" method="post" enctype="multipart/form-data" id="addimg">
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                        <label for="emp_id">Supervisor Id</label>
                                        <input type="text" class="form-control"  placeholder="Enter Employee Id" name="sup_id" value="{{$supervisor['user_id']}}" required>
                                      </div>



                                      <div class="form-group">
                                        <label for="emp_name">Supervisor name</label>
                                        <input type="text" class="form-control"  placeholder="Enter Employee name" name="sup_name" value="{{$supervisor['name']}}" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="ex">User type</label>
                                        <select class="browser-default custom-select" name="sup_user_type" required>
                                          <option value="{{$supervisor['user_type']}}">{{$supervisor['user_type']}}</option>
                                          @foreach($categories as $category)
                                          <option value="{{$category['zone_name']}}">{{$category['zone_name']}}</option>

                                          @endforeach
                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="emp_phone">Email</label>
                                        <input type="text" class="form-control"  placeholder="Enter Employee address" name="sup_email" value="{{$supervisor['email']}}" required>
                                      </div>

                                      <div class="float-right">
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-outline-primary btn-sm">Update</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Edit Modal end -->
                            <!-- Delete Modal start -->
                            <div class="modal fade" id="deleteEmp{{$supervisor['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" style="color:red;"  id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i> Delete confirmation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    Are you sure want to delete this?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal"><i class="fas fa-times"></i></button>
                                    <form class="" action="{{route('deleteSupervisor', $supervisor['id'])}}" method="post">
                                      {{ csrf_field() }}
                                      <button type="submit" class="btn btn-outline-success btn-sm"><i class="fas fa-check"></i></button>
                                    </form>

                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Delete Modal end -->

                          </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>
@endsection
