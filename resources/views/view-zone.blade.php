@extends('template')

@section('title')
view Zone
@endsection

@section('mainContent')
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('index')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">View-Category</li>
        </ol>
<div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
          <div class="card-header">
            <i class="fas fa-clipboard-list"></i>
            Employee attendance details</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>SL </th>
                    <th>Category name</th>
                    <th>Division</th>
                    <th>Edit category</th>

                  </tr>
                </thead>
               <!--  <tfoot>
                  <tr>
                   <th>zone id</th>
                    <th>zone name</th>
                    <th>division</th>
                    <th>Edit zone</th>
                  </tr>
                </tfoot> -->
                @php
                $i=1
                @endphp
                <tbody>
                   @foreach($zones as $zone)
                  <tr>

                    <td>{{$i}}</td>
                    <td>{{$zone['zone_name']}}</td>
                    <td>{{$zone['zone_division']}}</td>
                    <td>
                      <a href="#editEmp{{$zone['zone_id']}}" class="p-2 text-warning" data-toggle="modal" ><i class="fas fa-edit"></i></a>

                      <!-- Edit Modal start -->
                      <div class="modal fade" id="editEmp{{$zone['zone_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title text-warning"  id="exampleModalLabel"><i class="fas fa-edit"></i> Edit Informations</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form class="form-sample" action="{{route('updateZone', $zone['zone_id'])}}" method="post" enctype="multipart/form-data" id="addimg">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="zone_name">Category Name</label>
                                    <input type="text" class="form-control" id="zone_name" placeholder="Enter zone name" name="zone_name" value="{{$zone['zone_name']}}" required>
                                  </div>

                                  <div class="form-group">
                                    <label for="ex">Division</label>
                                    <select class="browser-default custom-select" name="zone_division" required>
                                      <option value="{{$zone['zone_division']}}">{{$zone['zone_division']}}</option>
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
                        </div>
                      </div>
                      <!-- Edit Modal end -->
                    </td>

                  </tr>
                   @php
                $i++
                @endphp
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>
@endsection
