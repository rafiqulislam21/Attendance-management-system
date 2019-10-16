@extends('template')

@section('title')
Add employee
@endsection

@section('mainContent')
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('index')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Add-employee</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
          <div class="card-header">
            <i class="fas fa-user-plus"></i>
            Add Employee form</div>
            <div class="card-body">
              <form class="form-sample" action="{{route('newEmployee')}}" method="post" enctype="multipart/form-data" id="addimg">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="emp_id">Employee Id</label>
                    <input type="text" class="form-control" id="emp_id" placeholder="Enter Employee Id" name="emp_id" required>
                  </div>

                  <div class="form-group">
                    <label for="emp_name">Employee name</label>
                    <input type="text" class="form-control" id="emp_name" placeholder="Enter Employee name" name="emp_name" required>
                  </div>
                  <div class="form-group">
                    <label for="emp_designation">Designation</label>
                    <input type="text" class="form-control" id="emp_designation" placeholder="Enter designation" name="emp_designation" required>
                  </div>

                  <div class="form-group">
                    <label for="emp_start_date">Start Date</label>
                    <input type="date" class="form-control" id="emp_start_date" placeholder="Enter start date" name="emp_start_date" required>
                  </div>

                   <div class="form-group">
                    <label for="ex">Supervisor</label>
                    <select class="browser-default custom-select" name="emp_supervisor" required>
                      <option selected value="">Select Supervisor</option>
                      @foreach($users as $user)

                        <option value="{{$user['user_id']}}">{{$user['name']}}</option>
                      @endforeach
                    </select>
                  </div>

                   <div class="form-group">
                    <label for="ex">Zone</label>
                    <select class="browser-default custom-select" name="emp_zone" required>
                      <option selected value="">Select Zone</option>
                      @foreach($zones as $zone)
                      <option value="{{$zone['zone_id']}}">{{$zone['zone_name']}}</option>
                      @endforeach
                    </select>
                  </div>

                <button type="submit" class="btn btn-primary">Submit</button>
              </form>

            </div>

        </div>
@endsection
