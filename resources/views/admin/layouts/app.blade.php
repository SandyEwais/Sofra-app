<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <script src="//unpkg.com/alpinejs" defer></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminAssets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminAssets/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.home')}}" class="brand-link">
      <img src="{{asset('adminAssets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sofra</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('adminAssets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li> --}}
          <li class="nav-item">
            <a href="{{route('restaurants.index')}}" class="nav-link">
              <i class="nav-icon fas fa-utensils"></i>
              <p>
                Restaurants
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('offers.index')}}" class="nav-link">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                Offers
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('payments.index')}}" class="nav-link">
              <i class="nav-icon far fa-credit-card"></i>
              <p>
                Payments
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('cities.index')}}" class="nav-link">
              <i class="nav-icon 	fas fa-city"></i>
              <p>
                Cities
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('categories.index')}}" class="nav-link">
              <i class="nav-icon 	fas fa-boxes"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('neighborhoods.index')}}" class="nav-link">
              <i class="nav-icon 	fas fa-map"></i>
              <p>
                Neighborhoods
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('contact-messages.index')}}" class="nav-link">
              <i class="nav-icon fas fa-comment"></i>
              <p>
                Contact Messages
              </p>
            </a>
          </li>
          <li class="nav-item">
              <button class="nav-link" id="logoutBtn"><i class="nav-icon fas fa-sign-out-alt"></i>Logout</button>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('title')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Reusable Modal -->
      <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="confirmationModalTitle"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
                Are You Sure?
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
              <button id="proceedBtn" class="">Proceed</button>
              
              
            </div>
          </div>
        </div>
      </div>
      <!-- /.Reusable Modal -->

      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('adminAssets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminAssets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminAssets/dist/js/adminlte.min.js')}}"></script>
<script>
  $(document).ready(function(){
    $("#logoutBtn").click(function(){
      $("#confirmationModal").modal();
      $("#confirmationModalTitle").html("Logout");
      $("#proceedBtn").removeClass("btn btn-danger").addClass("btn btn-secondary");
    });
    $("#proceedBtn").click(function(){
      var title = $("#confirmationModalTitle").html();
      if(title == 'Logout'){
        $.ajax({
          type: "POST",
          url: "{{route('logout')}}",
          data: {
            "_token": "{{ csrf_token() }}"
          },
          success: function (data) {
            location.reload();
          },
          error: function (error) {
            location.reload();
          }
        });
      }else if(title == 'Deletion'){
        var data = $(this).attr('data-value');
        var array = data.split(',');
        var destination = array[0];
        var id = array[1];
        console.log(destination+id);
        $.ajax({
        url: "/admin/"+destination+"/"+id,
        type: 'DELETE',
        data: {
            
            "_token": "{{ csrf_token() }}",
            "id": id
        },
        success: function (){
            location.reload();
        },
        error: function (){
           location.reload();
        }
        });
      }
    })
  });
  
</script>
@stack('scripts')
</body>
</html>
