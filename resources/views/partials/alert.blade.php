@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <!-- <strong>success!</strong> -->
  {{ session('success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if(session('warning'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <!-- <strong>success!</strong> -->
  {{ session('warning')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
