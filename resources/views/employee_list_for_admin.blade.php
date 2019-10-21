@extends('template')

@section('title')
Employee-list
@endsection

@section('mainContent')
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('index')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Employee-list</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
          <div class="card-header">
            <i class="fas fa-list-ul"></i>
            Employee table

            <div class="float-right">
              <a href="{{route('addemployee')}}" class="btn btn-outline-success"><i class="fas fa-plus-circle"></i></a>
            </div>
          </div>
          <div class="card-body">
            <!-- @include('partials.alert') -->
            <form class="form-data" data-route="{{route('employeelistForAdminZone')}} " method="POST">
              {{csrf_field()}}
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">

                    <label for="ex">Select Zone</label>
                    <select class="browser-default custom-select" name="zone_id" required>
                      <option value="">Select</option>
                      @foreach($zones as $zone)

                      <option value="{{$zone['zone_id']}}">{{$zone['zone_name']}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3 pt-4">
                  <button type="submit" class="btn btn-outline-primary">Show</button>
                </div>
              </div>
            </form>
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Supervisor</th>
                    <th>View/Edit/Delete</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($employees as $employee)
                  <tr>
                    <td>{{$employee['employee_id']}}</td>
                    <td>{{$employee['employee_name']}}</td>
                    <td>{{$employee['sup_name']}}</td>
                    <td>
                            <a href="#viewEmp{{$employee['id']}}" class="p-2 text-primary" data-toggle="modal" ><i class="fas fa-eye"></i></a>
                            <a href="#editEmp{{$employee['id']}}" class="p-2 text-warning" data-toggle="modal" ><i class="fas fa-edit"></i></a>
                            <a href="#deleteEmp{{$employee['id']}}" class="p-2 text-danger" data-toggle="modal" ><i class="fas fa-trash-alt"></i></a>

                            <!-- view Modal start -->
                            <div class="modal fade" id="viewEmp{{$employee['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <h1 class="display-4">{{$employee['employee_name']}}</h1>
                                        <p >Employee Id: {{$employee['employee_id']}}</p>
                                        <p >designation: {{$employee['designation']}}</p>
                                        <p >Start date: {{$employee['start_date']}}</p>
                                        <p >Supervisor: {{$employee['sup_name']}}</p>
                                        <p >Zone: {{$employee['zone_name']}}</p>
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
                            <div class="modal fade" id="editEmp{{$employee['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title text-warning"  id="exampleModalLabel"><i class="fas fa-edit"></i> Edit Informations</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form class="form-sample" action="{{route('updateEmployee', $employee['id'])}}" method="post" enctype="multipart/form-data" id="addimg">
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                        <label for="emp_id">Employee Id</label>
                                        <input type="text" class="form-control" id="emp_id" placeholder="Enter Employee Id" name="emp_id" value="{{$employee['employee_id']}}" required>
                                      </div>

                                      <div class="form-group">
                                        <label for="emp_name">Employee name</label>
                                        <input type="text" class="form-control" id="emp_name" placeholder="Enter Employee name" name="emp_name" value="{{$employee['employee_name']}}" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="ex">Designation</label>
                                        <input type="text" class="form-control" id="emp_gender" placeholder="Enter Employee name" name="emp_gender" value="{{$employee['designation']}}" required>
                                      </div>

                                      <div class="form-group">
                                        <label for="emp_phone">Start date</label>
                                        <input type="text" class="form-control" id="emp_phone" placeholder="Enter Employee address" name="emp_phone" value="{{$employee['start_date']}}" required>
                                      </div>

                                      <div class="form-group">
                                        <label for="ex">Supervisor</label>
                                        <select class="browser-default custom-select" name="emp_supervisor" required>
                                          <option value="{{$employee['supervisor_id']}}">{{$employee['sup_name']}}</option>
                                          @foreach($supervisors as $supervisor)
                                          <option value="{{$supervisor['user_id']}}">{{$supervisor['name']}}</option>
                                          @endforeach
                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="ex">Zone</label>
                                        <select class="browser-default custom-select" name="emp_zone" required>
                                          <option value="{{$employee['zone_id']}}">{{$employee['zone_name']}}</option>
                                          @foreach($zones as $zone)
                                          <option value="{{$zone['zone_id']}}">{{$zone['zone_name']}}</option>
                                          @endforeach
                                        </select>
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
                            <div class="modal fade" id="deleteEmp{{$employee['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <form class="" action="{{route('deleteEmployee', $employee['id'])}}" method="post">
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
