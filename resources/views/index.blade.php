@extends('template')

@section('title')
Ptcattendance home
@endsection

@section('mainContent')
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">

            <a href="{{route('index')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          @if(Auth::user()->user_type == "Admin")
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-user-tie"></i>
                </div>
                <h6>Total supervisor: </h6>

                <h3>{{$totalSupervisor}}</h3>
                <!-- <div class="mr-5">300</div> -->
              </div>
              <!-- <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a> -->
            </div>
          </div>
          @endif
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-users"></i>
                </div>
                <h6>Total employee: </h6>
                @if(Auth::user()->user_type == "Admin")
                <h3>{{$totalEmployee}}</h3>
                @else
                <h3>{{$totalEmployee}}</h3>
                @endif
                <!-- <div class="mr-5">300</div> -->
              </div>
              <!-- <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a> -->
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-list-ol"></i>
                </div>
                <h6>Total Zone: </h6>
                <h3>{{$totalZone}}</h3>
                <!-- <div class="mr-5">300</div> -->
              </div>
              <!-- <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a> -->
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <!-- <i class="fas fa-fw fa-list"></i> -->
                  <i class="far fa-clock"></i>
                </div>
                <h6 style="font-size: 35px ;margin-top: 20px;" class="mr-0" id="myClock"></h6>
              </div>

            </div>
          </div>
          <!-- <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5">11 New Tasks!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5">123 New Orders!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5">13 New Tickets!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div> -->
        </div>


  <script type="text/javascript">
          function showTime(){
            var date = new Date();
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
            document.getElementById("myClock").innerText = time;
            document.getElementById("myClock").textContent = time;
            setTimeout(showTime,1000);
          }
          showTime();
           //setInterval(showTime,1000);
        </script>

@endsection
