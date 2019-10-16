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

    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>id</th>
            <th>Name</th>
            <th>Supervisor</th>
            <th>View</th>
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
                        <p >Designation: {{$employee['designation']}}</p>
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

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
