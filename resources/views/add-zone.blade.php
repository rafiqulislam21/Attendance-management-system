@extends('template')

@section('title')
Add Zone
@endsection

@section('mainContent')
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('index')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Add-Category</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
          <div class="card-header">
            <i class="fas fa-user-plus"></i>
            Add Category form</div>
            <div class="card-body">
              <form class="form-sample" action="{{route('newZone')}}" method="post" enctype="multipart/form-data" id="addimg">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="zone_name">Category Name</label>
                    <input type="text" class="form-control" id="zone_name" placeholder="Enter zone name" name="zone_name" required>
                  </div>

                  <div class="form-group">
                    <label for="ex">Division</label>
                    <select class="browser-default custom-select" name="zone_division" required>
                      <option selected value="">Select Division</option>
                      <option value="Dhaka">Dhaka</option>
                      <option value="Rajshahi">Rajshahi</option>
                      <option value="Chittagong">Chittagong</option>
                      <option value="Khulna">Khulna</option>
                      <option value="Mymensingh">Mymensingh</option>
                      <option value="Rangpur">Rangpur</option>
                      <option value="Sylhet ">Sylhet </option>

                    </select>
                  </div>

                <button type="submit" class="btn btn-primary">Submit</button>
              </form>

            </div>

        </div>
@endsection
