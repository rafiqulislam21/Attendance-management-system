@extends('template')

@section('title')
Edit Attendance
@endsection

@section('mainContent')

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('index')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Edit-Employee-attendancee</li>
</ol>

<!-- DataTables Example -->


<span id="digitalClock" class="clock"></span>
<span id="currentDate" class="clock "></span>
<div class="card mb-3 shadow p-3 mb-5 bg-white rounded">

  <div class="card-header">
    <i class="fas fa-file-alt"></i>
    Employee attendance form</div>

    <form  action="{{route('attendanceEditBySup')}}" method="post">
        {{ csrf_field() }}
        <div class="row py-3">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-4 py-2">
                <label for="ex">Select Supervisor</label>
              </div>
              <div class="col-md-8 py-2">
                <select class="browser-default custom-select" name="supervisor_id" required>
                  <option value="">Select</option>
                  @foreach($supervisors as $supervisor)
                  <option value="{{$supervisor['user_id']}}">{{$supervisor['name']}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="row">
              <div class="col-md-4 py-2">
                <label for="ex">Select Day</label>
              </div>
              <div class="col-md-8 py-2">
                <select class="browser-default custom-select" name="day" required>
                  <option value="">Select</option>
                  <option value="Today">Today</option>
                  <option value="Yesterday">Yesterday</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary py-2">Show</button>
          </div>
        </div>
    </form>

        <form class="submitform" action="{{route('submitAttendanceUpdate')}}" method="post">
            {{ csrf_field() }}
        <div class="table-responsive overflow-auto" style="height:300px;">
          <table class="table table-bordered table-hover" width="100%">
            <thead>
              <tr>

                <th>Id</th>
                <th>Name</th>
                <th>attendance</th>

              </tr>
            </thead>

            <tbody>

              @php $i=0 @endphp
              @foreach($employees as $employee)
              <tr>

                <td>{{$employee['employee_id']}}  <input style="display: none;" type="text" name="employee_id[]" value="{{$employee['employee_id']}}"></td>
                <td>{{$employee['employee_name']}} <input style="display: none;" type="text" name="employee_name[]" value="{{$employee['employee_name']}}"></td>
                <td>
                <!-- Default unchecked -->
                <!-- Default inline 1-->
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="present{{$employee['employee_id']}}" name="attendance_taking[]{{$employee['employee_id']}}" value="present"  required="true" @if($employee['status']=='present') checked @endif >
                  <label class="custom-control-label" for="present{{$employee['employee_id']}}">Present</label>
                </div>

                <!-- Default inline 2-->
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="absent{{$employee['employee_id']}}" name="attendance_taking[]{{$employee['employee_id']}}" value="absent" required="true" @if($employee['status']=='absent') checked @endif>
                  <label class="custom-control-label" for="absent{{$employee['employee_id']}}">Absent</label>
                </div>

                <!-- Default inline 3-->
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="late{{$employee['employee_id']}}" name="attendance_taking[]{{$employee['employee_id']}}" value="late" required="true" @if($employee['status']=='late') checked @endif>
                  <label class="custom-control-label" for="late{{$employee['employee_id']}}">Late</label>
                </div>

                <div class=" custom-control-inline">
                  <input class="form-control form-control-sm" type="text" placeholder="Comment" name="attendance_comment[]{{$employee['employee_id']}}" value="{{$employee['comment']}}">
                </div>

              </td>

            </tr>
            @php $i++ @endphp
            @endforeach

            <input style="display: none;" type="text" name="total_employee" value="{{$i}}">

          </tbody>


        </table>
      </div>
      <button type="submit" class="btn btn-primary float-right pr-2 mt-3">Update</button>
    </div>

  </form>
  <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type="text/javascript">
function showTime(){
  var date = new Date();
  document.getElementById("currentDate").innerText = date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear();
  document.getElementById("currentDate").textContent =date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear();
  var h = date.getHours();
  var m = date.getMinutes();
  var s = date.getSeconds();
  var session = "AM";
  if(h==0){
    h=12;
  }
  if(h>12){
    h=h-12;
    session = "PM";
  }
  // if(h<10){
  //   h = "0"+h;
  // }
  // if(m<10){
  //   m= "0"+m;
  // }
  // if(s<10){
  //   s="0"+s;
  // }
  h = (h<10) ? "0"+ h : h;
  m = (m<10) ? "0"+ m : m;
  s = (s<10) ? "0"+ s : s;
  var time = h +":" + m +":" + s+ " " + session;
  document.getElementById("digitalClock").innerText = time;
  document.getElementById("digitalClock").textContent = time;
  setTimeout(showTime,1000);
}
showTime();
//setInterval(showTime,1000);

$(".submitform").submit(function() {
   // $(this).find('input[type="submit"]').prop("disabled", true);
   alert("You are going to edit attendance.");
});

</script>
@endsection
