<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title')</title>

  <link rel="icon" type="image/ico" href="{{asset('images/ptc_logo_small.png')}}" />
  <!-- Custom fonts for this page-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- fontawesome cdn -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
  <!-- Custom styles for this page-->
  <link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">
<link href="{{asset('css/style.css')}}" rel="stylesheet">


</head>

<body id="page-top">
  @include('partials.navbar')
  <div id="wrapper">
    @include('partials.sidebar')
    <div id="content-wrapper">
      <div class="container-fluid">
        @include('partials.alert')
        @yield('mainContent')
      </div>
      <!-- /.container-fluid -->
      <!-- Sticky Footer -->
      @include('partials.fotter')
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- /#wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

   <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>

  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!-- Bootstrap core JavaScript-->

  <!-- <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> -->
  <!-- Core plugin JavaScript-->
  <!-- <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script> -->
  <!-- Page level plugin JavaScript-->
  <!-- <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script> -->
  <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin.min.js')}}"></script>
  <!-- Demo scripts for this page-->
  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
  <!-- <script src="{{asset('js/demo/chart-area-demo.js')}}"></script> -->


<script type="text/javascript">
$('#editTitleModal').on('show.bs.modal', function (event) {
// console.log("modal opened");
var button = $(event.relatedTarget)
var imgTitle = button.data('id')
console.log(imgTitle);
var imgId = button.data('name')
var imgSrc = button.data('division')
var modal = $(this)



modal.find('.modal-body #img_title').val(imgTitle)
modal.find('.modal-body #img_id').val(imgId)
modal.find('.modal-body #img_src').val(imgSrc)
})
</script>
</body>

</html>
