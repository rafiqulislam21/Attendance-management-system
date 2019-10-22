@extends('template')

@section('title')
Employee-attendancee-details
@endsection

@section('mainContent')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('index')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Employee-attendancee-details</li>
</ol>

<!-- DataTables Example -->
<div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
  <div class="card-header">
    <i class="fas fa-clipboard-list"></i>
    Employee attendance details</div>
    <div class="card-body">
      <form class="form-data" action="{{route('attendancedetailsByDaySupervisor',Auth::user()->user_id)}} " method="POST">
        {{csrf_field()}}
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="ex">Day</label>
              <select class="browser-default custom-select" name="day_name" required>
                <option value="">Select</option>
                <option value="all">all</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="ex">Month</label>
              <select class="browser-default custom-select" name="month_name" required>
                <option value="">Select</option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="ex">Year</label>
              <select class="browser-default custom-select" name="year_name" required>
                <option value="">Select</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
              </select>
            </div>
          </div>
          <div class="col-md-3 pt-4">
            <button type="submit" class="btn btn-outline-primary">Show</button>
          </div>
        </div>
      </form>

      <!-- <div class="form-group">
        <div class="input-group">
         <span class="input-group-addon">Search</span>
         <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
        </div>
       </div>
       <div id="result"></div> -->

      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Total day</th>
              <th colspan="2">Present</th>
              <th colspan="2">Late</th>
              <th colspan="2">Absent</th>
              <th>Comment</th>
            </tr>
          </thead>

          <tbody class="tbody">
            @foreach($attendanceDetails as $row)
            <tr>
              <td>{{$row['employee_id']}}</td>
              <td>{{$row['employee_name']}}</td>
              <td>{{$row['total_day']}}</td>
              <td>{{$row['total_present_day']}}</td>
              <td>{{$row['total_present_percentage']}} %</td>
              <td><a href="#lateEmp{{$row['employee_id']}}" data-toggle="modal">{{$row['total_late_day']}}</a></td>
              <td>{{$row['total_late_percentage']}} %</td>
              <td><a href="#absentEmp{{$row['employee_id']}}" data-toggle="modal">{{$row['total_absent_day']}}</a></td>
              <td>{{$row['total_absent_percentage']}} %</td>
              <td><a href="#commentEmp{{$row['employee_id']}}" data-toggle="modal">{{$row['employee_comment']}}</a></td>
            </tr>

            <!-- view late Modal start -->
            <div class="modal fade" id="lateEmp{{$row['employee_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                <h5 class="modal-title text-primary"  id="exampleModalLabel"><i class="fas fa-eye"></i></i> View all late days</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <center><h1 class="display-3"><i class="far fa-user"></i></h1></center>
                      <div class="form-group">
                        <h1>{{$row['employee_name']}}</h1>
                        @if($row['total_late_day_date'] != "")
                          <ol>
                            <p>Date--------------------------Status</p>

                          @foreach($row['total_late_day_date'] as $row2)
                            <li>{{$row2->day}}-{{$row2->month}}-{{$row2->year}} <span>--------> Late</li>

                          @endforeach
                        </ol>
                        @endif
                      </div>
                      <div class="float-right">
                        <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Ok</button>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- view late Modal end -->
            <!-- view absent Modal start -->
            <div class="modal fade" id="absentEmp{{$row['employee_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                <h5 class="modal-title text-primary"  id="exampleModalLabel"><i class="fas fa-eye"></i></i> View all absent days</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <center><h1 class="display-3"><i class="far fa-user"></i></h1></center>
                      <div class="form-group">
                        <h1>{{$row['employee_name']}}</h1>
                        @if($row['total_absent_day_date'] != "")
                          <ol>
                            <p>Date---------------------------Status</p>

                          @foreach($row['total_absent_day_date'] as $row2)
                            <li>{{$row2->day}}-{{$row2->month}}-{{$row2->year}} <span>--------> Absent</span></li>


                          @endforeach
                        </ol>
                        @endif
                      </div>
                      <div class="float-right">
                        <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Ok</button>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- view absent end -->
            <!-- view comment Modal start -->
            <div class="modal fade" id="commentEmp{{$row['employee_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                <h5 class="modal-title text-primary"  id="exampleModalLabel"><i class="fas fa-eye"></i></i> View all comments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <center><h1 class="display-3"><i class="far fa-user"></i></h1></center>
                      <div class="form-group">
                        <h1>{{$row['employee_name']}}</h1>
                        @if($row['employee_single_comment'] != "")
                          <ol>
                            <p>Date------------------------Comment</p>

                          @foreach($row['employee_single_comment'] as $row2)
                            <li>{{$row2->day}}-{{$row2->month}}-{{$row2->year}} <span>--------> {{$row2->comment}}</span></li>


                          @endforeach
                        </ol>
                        @endif
                      </div>
                      <div class="float-right">
                        <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Ok</button>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- view absent end -->


            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
  </div>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">
  $( function(){
    $('.form-data').submit(function(e){
      var route = $('.form-data').data('route');
      var form_data = $(this);


      $.ajax({
        type:'POST',
        url:route,
        data:form_data.serialize(),
        success:function(Response){

          if (Response==0) {
            // console.log(Response);
            $(".tbody").empty();
            alert("Attendance was not taken that day!");
          }else {
            $(".tbody").empty();
            $.each(Response, function(key, value) {
              // console.log(value.employee_name);

              $('.tbody').append('<tr><td>'+value.employee_id+'</td><td>'+value.employee_name+'</td><td>'+value.total_day+'</td><td>'+value.total_present_day+'</td><td>'+value.total_present_percentage+' %</td><td>'+value.total_late_day+'</td><td>'+value.total_late_percentage+' %</td><td>'+value.total_absent_day+'</td><td>'+value.total_absent_percentage+' %</td><td>'+value.employee_comment+'</td></tr>')

              });
          }

          // $.each(Response, function() {
          //   $.each(this, function(k, v) {
          //     $('.tbody').append('<tr><td>'+v.employee_id+'</td><td>v["employee_name"]</td><td>v["total_day"]</td><td>v["total_present_day"]</td><td>v["total_late_day"]</td><td>v["total_absent_day"]</td></tr>')
          //   });
          // });

        }
      });
      e.preventDefault();
    });
  });

  </script> -->


  @endsection
