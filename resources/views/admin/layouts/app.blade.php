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
        <a href="{{route('admin.home')}}" class="nav-link {{ (request()->is('admin')) ? 'active' : '' }}"><i class="nav-icon fas fa-home"></i> Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('change_password')}}" class="nav-link {{ (request()->is('admin/change-password')) ? 'active' : '' }}"><i class="nav-icon fas fa-lock"></i> Change Password</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" id="logoutBtn"><i class="nav-icon fas fa-sign-out-alt"></i> Logout</a>
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
      <img src="{{asset('adminAssets/dist/img/sofraLOGO.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sofra</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('adminAssets/dist/img/user1-128x128.jpg')}}" class="img-circle elevation-2" alt="User Image">
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
          @if(Auth::user()->can('users_access') || Auth::user()->can('roles_access'))
            <li class="nav-item {{ (request()->is('admin/users*') || request()->is('admin/roles*')) ? 'menu-is-opening menu-open' : '' }}">
              <a href="#" class="nav-link {{ (request()->is('admin/users*') || request()->is('admin/roles*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard Permissions
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('users_access')
                  <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link {{ (request()->is('admin/users*')) ? 'active' : '' }}">
                      <i class="fas fa-users nav-icon"></i>
                      <p>Users</p>
                    </a>
                  </li>
                @endcan
                @can('roles_access')
                  <li class="nav-item">
                    <a href="{{route('roles.index')}}" class="nav-link {{ (request()->is('admin/roles*')) ? 'active' : '' }}">
                      <i class="fas fa-cogs nav-icon"></i>
                      <p>Roles</p>
                    </a>
                  </li>
                @endcan
              </ul>
            </li>
          @endif
          
          @can('clients_access')
            <li class="nav-item">
              <a href="{{route('clients.index')}}" class="nav-link {{ (request()->is('admin/clients*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Clients
                </p>
              </a>
            </li>
          @endcan
          @can('restaurants_access')
            <li class="nav-item">
              <a href="{{route('restaurants.index')}}" class="nav-link {{ (request()->is('admin/restaurants*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-utensils"></i>
                <p>
                  Restaurants
                </p>
              </a>
            </li>
          @endcan
          @can('orders_access')
            <li class="nav-item">
              <a href="{{route('orders.index')}}" class="nav-link {{ (request()->is('admin/orders*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-box"></i>
                <p>
                  Orders
                </p>
              </a>
            </li>
          @endcan
          @can('offers_access')
            <li class="nav-item">
              <a href="{{route('offers.index')}}" class="nav-link {{ (request()->is('admin/offers*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>
                  Offers
                </p>
              </a>
            </li>
          @endcan
          @can('payments_access')
            <li class="nav-item">
              <a href="{{route('payments.index')}}" class="nav-link {{ (request()->is('admin/payments*')) ? 'active' : '' }}">
                <i class="nav-icon far fa-credit-card"></i>
                <p>
                  Payments
                </p>
              </a>
            </li>
          @endcan
          @can('cities_access')
            <li class="nav-item">
              <a href="{{route('cities.index')}}" class="nav-link {{ (request()->is('admin/cities*')) ? 'active' : '' }}">
                <i class="nav-icon 	fas fa-city"></i>
                <p>
                  Cities
                </p>
              </a>
            </li>
          @endcan
          @can('categories_access')
            <li class="nav-item">
              <a href="{{route('categories.index')}}" class="nav-link {{ (request()->is('admin/categories*')) ? 'active' : '' }}">
                <i class="nav-icon 	fas fa-boxes"></i>
                <p>
                  Categories
                </p>
              </a>
            </li>
          @endcan
          @can('neighborhoods_access')
            <li class="nav-item">
              <a href="{{route('neighborhoods.index')}}" class="nav-link {{ (request()->is('admin/neighborhoods*')) ? 'active' : '' }}">
                <i class="nav-icon 	fas fa-map"></i>
                <p>
                  Neighborhoods
                </p>
              </a>
            </li>
          @endcan
          @can('contact-messages_access')
            <li class="nav-item">
              <a href="{{route('contact-messages.index')}}" class="nav-link {{ (request()->is('admin/contact-messages*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-comment"></i>
                <p>
                  Contact Messages
                </p>
              </a>
            </li>
          @endcan
          @can('settings_access')
            <li class="nav-item">
              <a href="{{route('settings.index')}}" class="nav-link {{ (request()->is('admin/settings*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Settings
                </p>
              </a>
            </li>
          @endcan
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
    $("#logoutBtn").click(function(e){
      e.preventDefault();
      
      $("#confirmationModal").modal();
      $("#confirmationModalTitle").html("Logout");
      $("#proceedBtn").removeClass("btn btn-danger btn-warning").addClass("btn btn-secondary");
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
      }else if(title == 'Activation' || title == 'Deactivation'){
        var data = $(this).attr('data-value');
        var array = data.split(',');
        var destination = array[0];
        var id = array[1];
        var process = array[2];
        if(process == 'Activation'){
          $.ajax({
          url: "/admin/"+destination+"/"+id+"/activate",
          type: 'POST',
          data: {
              
              "_token": "{{ csrf_token() }}",
              "id": id
          },
          success: function (){
            location.reload()
          },
          error: function (){
            location.reload();
          }
          });
        }else if(process == 'Deactivation'){
          $.ajax({
          url: "/admin/"+destination+"/"+id+"/deactivate",
          type: 'POST',
          data: {
              
              "_token": "{{ csrf_token() }}",
              "id": id
          },
          success: function (){
            location.reload()
          },
          error: function (error){
            console.log(error);
          }
          });
        }
        
      }
    })
  });
  
</script>
@stack('scripts')
</body>
</html>
