@extends('template')

@section('title')
Add Supervisor
@endsection

@section('mainContent')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('index')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Add-supervisor</li>
</ol>

<!-- DataTables Example -->
<div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
  <div class="card-header">
    <i class="fas fa-user-plus"></i>
    Add Supervisor form</div>
    <div class="card-body">
      <form class="form-sample" action="{{route('newSupervisor')}}" method="post" enctype="multipart/form-data" id="addimg">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="sup_id">Supervisor Login Id</label>
          <input type="text" class="form-control" id="sup_id" placeholder="Enter Supervisor login Id" name="sup_id" required>
        </div>

        <div class="form-group">
          <label for="sup_password">Supervisor Login Password</label>
          <input type="password" class="form-control" id="sup_password" placeholder="Enter Supervisor login Password" name="sup_password" required>
        </div>

        <div class="form-group">
          <label for="sup_name">Supervisor name</label>
          <input type="text" class="form-control" id="sup_name" placeholder="Enter Supervisor name" name="sup_name" required>
        </div>
        <div class="form-group">
          <label for="ex">Gender</label>
          <select class="browser-default custom-select" name="sup_gender" required>
            <option selected value="">Select gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
        </div>

        <div class="form-group">
          <label for="sup_phone">Phone number</label>
          <input type="text" class="form-control" id="sup_phone" placeholder="Enter Supervisor Phone Number" name="sup_phone" required>
        </div>

        <div class="form-group">
          <label for="ex">Zone</label>
          <select class="browser-default custom-select" name="sup_zone" required>
            <option selected value="">Select Zone</option>
            @foreach($zones as $zone)
            <option value="{{$zone['zone_id']}}">{{$zone['zone_name']}}</option>
            @endforeach
          </select>
        </div>

        <div class="float-right">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
  @endsection
