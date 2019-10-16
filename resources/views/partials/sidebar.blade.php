<!-- Sidebar -->
<ul class="sidebar navbar-nav">
  <li class="nav-item active">
    <a class="nav-link" href="{{route('index')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-chalkboard-teacher"></i>
      <span>Attendance</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <h6 class="dropdown-header">Attendance Pages:</h6>
      @if(Auth::user()->user_type!="Admin")
      <a class="dropdown-item" href="{{route('attendance' , Auth::user()->user_id)}}"><i class="fas fa-file-alt"></i> Take attendance</a>
      <a class="dropdown-item" href="{{route('attendancedetailsForSupervisor', Auth::user()->user_id)}}"><i class="fas fa-clipboard-list"></i> Attendance details</a>
      @endif

      @if(Auth::user()->user_type=="Admin")
      <a class="dropdown-item" href="{{route('attendancedetails')}}"><i class="fas fa-clipboard-list"></i> Attendance details</a>
      <a class="dropdown-item" href="{{route('attendanceEdit')}}"><i class="far fa-edit"></i> Edit attendance</a>
      @endif
    </div>
  </li>

  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-users"></i>
      <span>Employees</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <h6 class="dropdown-header">Employee Pages:</h6>
      @if(Auth::user()->user_type=="Admin")
      <a class="dropdown-item" href="{{route('addemployee')}}"> <i class="fas fa-user-plus"></i> Add employee</a>
      <a class="dropdown-item" href="{{route('employeelistForAdmin')}}"> <i class="fas fa-address-book"></i> Employee list</a>
      @endif
      @if(Auth::user()->user_type!="Admin")
      <a class="dropdown-item" href="{{route('employeelist',Auth::user()->user_id)}}"> <i class="fas fa-address-book"></i> Employee list</a>
      @endif
    </div>
  </li>

 @if(Auth::user()->user_type=="Admin")
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-user-shield"></i>
      <span>Office Admins</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <h6 class="dropdown-header">Admins Pages:</h6>
      <a class="dropdown-item" href="{{route('register')}}"> <i class="fas fa-user-plus"></i> Add Admin</a>
      <a class="dropdown-item" href="{{route('viewSupervisor')}}"> <i class="fas fa-address-book"></i> Admins list</a>
    </div>
  </li>


  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-list-ol"></i>
      <span>Category</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <h6 class="dropdown-header">Category Pages:</h6>
      <a class="dropdown-item" href="{{route('addZone')}}"> <i class="fas fa-user-plus"></i> Add Category</a>
      <a class="dropdown-item" href="{{route('viewZone')}}"> <i class="fas fa-address-book"></i> Category list</a>
    </div>
  </li>
  @endif



  <!-- <li class="nav-item">
    <a class="nav-link" href="charts.html">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Charts</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="tables.html">
      <i class="fas fa-fw fa-table"></i>
      <span>Tables</span></a>
  </li> -->
</ul>
