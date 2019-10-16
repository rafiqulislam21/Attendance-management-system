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
      <form class="form-data" data-route="{{route('attendancedetailsByDay')}} " method="POST">
        {{csrf_field()}}
        <div class="row">
          <div class="col-md-2">
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
          <div class="col-md-2">
            <div class="form-group">
              <label for="ex">Year</label>
              <select class="browser-default custom-select" name="year_name" required>
                <option value="">Select</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="ex">Select Supervisor</label>
              <select class="browser-default custom-select" name="supervisor_id" required>
                <option value="">Select</option>
                @foreach($supervisors as $supervisor)
                <option value="{{$supervisor['user_id']}}">{{$supervisor['name']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-3 pt-4">
            <button type="submit" class="btn btn-outline-primary">Show</button>
          </div>
        </div>
      </form>

      <div class="col-md-6">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="notice-search"  placeholder="Search">
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Total day</th>
              <th colspan="2">Present</th>
              <th colspan="2">Late</th>
              <th colspan="2">Absent</th>
            </tr>
          </thead>

          <tbody class="tbody">
            @foreach($attendanceDetails as $attendance)
            <!-- <tr>
              <td>{{$attendance['employee_id']}}</td>
              <td>{{$attendance['employee_name']}}</td>
              <td>{{$attendance['total_day']}}</td>
              <td>{{$attendance['total_present_day']}}</td>
              <td>{{$attendance['total_late_day']}}</td>
              <td>{{$attendance['total_absent_day']}}</td>
            </tr> -->
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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

              $('.tbody').append('<tr class="dataShow"><td>'+value.employee_id+'</td><td>'+value.employee_name+'</td><td>'+value.total_day+'</td><td>'+value.total_present_day+'</td><td>'+value.total_present_percentage+' %</td><td>'+value.total_late_day+'</td><td>'+value.total_late_percentage+' %</td><td>'+value.total_absent_day+'</td><td>'+value.total_absent_percentage+' %</td></tr>')

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

  $(document).on( "keyup", '#notice-search', function(){

                    var txt = $(this).val();
                    //console.log(txt.toUpperCase());

                    $('.dataShow').each(function(){
                      // alert("this works");
                        if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1){
                            $(this).show();


                        }

                    });
                });

  </script>
  @endsection
