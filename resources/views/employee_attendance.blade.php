@extends('template')

@section('title')
Employee-attendancee
@endsection

@section('mainContent')

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('index')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Employee-attendancee</li>
</ol>

<!-- DataTables Example -->



<div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
<div class="container">
<span  id="digitalClock" class="clock"></span>
<span style="float:right;" id="currentDate" class="clock "></span>
</div>
  <div class="card-header">
    <i class="fas fa-file-alt"></i>
    Employee attendance form</div>
    <form class="submitform" action="{{route('submitAttendance', Auth::user()->user_id)}}" method="post">
      <div class="card-body">
        <div class="table-responsive overflow-auto" style="height:300px;">
          <table class="table table-bordered table-hover" width="100%">
            <thead>
              <tr>

                <th class="text-center">Id</th>
                <th class="text-center">Name</th>
                <th class="text-center">Attendance</th>


              </tr>
            </thead>

            <tbody>

              {{ csrf_field() }}
              @php $i=0 @endphp
              @foreach($employees as $employee)
              <tr>

                <td>{{$employee['employee_id']}}  <input style="display: none;" type="text" name="employee_id[]" value="{{$employee['employee_id']}}"></td>
                <td>{{$employee['employee_name']}} <input style="display: none;" type="text" name="employee_name[]" value="{{$employee['employee_name']}}"></td>
                <td>
                  <!-- <div class="custom-control custom-checkbox  "  >
                  <input  type="checkbox" class="custom-control-input" id="{{$employee['id']}}" value="1" name="attendance_check[]">
                  <label class="custom-control-label" for="{{$employee['id']}}" ></label>

                </div> -->
                <!-- Default unchecked -->
                <!-- Default inline 1-->
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="present{{$employee['employee_id']}}" name="attendance_taking[]{{$employee['employee_id']}}" value="present"  required="true" checked>
                  <label class="custom-control-label" for="present{{$employee['employee_id']}}">Present</label>
                </div>

                <!-- Default inline 2-->
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="absent{{$employee['employee_id']}}" name="attendance_taking[]{{$employee['employee_id']}}" value="absent" required="true" >
                  <label class="custom-control-label" for="absent{{$employee['employee_id']}}">Absent</label>
                </div>

                <!-- Default inline 3-->
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="late{{$employee['employee_id']}}" name="attendance_taking[]{{$employee['employee_id']}}" value="late" required="true" >
                  <label class="custom-control-label" for="late{{$employee['employee_id']}}">Late</label>
                </div>

               <div class=" custom-control-inline">

                 <input class="form-control form-control-sm" type="text" placeholder="Comment" name="attendance_comment[]{{$employee['employee_id']}}" >
                </div>

              </td>

            </tr>
            @php $i++ @endphp
            @endforeach

            <input style="display: none;" type="text" name="total_employee" value="{{$i}}">

          </tbody>


        </table>
      </div>

    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
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

  h = (h<10) ? "0"+ h : h;
  m = (m<10) ? "0"+ m : m;
  s = (s<10) ? "0"+ s : s;
  var time = h +":" + m +":" + s+ " " + session;
  document.getElementById("digitalClock").innerText = time;
  document.getElementById("digitalClock").textContent = time;
  setTimeout(showTime,1000);
}
showTime();
$(".submitform").submit(function() {
   // $(this).find('input[type="submit"]').prop("disabled", true);
   alert("You are going to take attendance for today");
});
</script>
@endsection
