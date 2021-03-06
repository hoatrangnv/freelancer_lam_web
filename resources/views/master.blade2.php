<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DoiThe.Pro</title>

    <!-- Bootstrap core CSS-->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="/">DoiThe.Pro</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
         
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        @if(Auth::guest())
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="/login">
           
            Đăng Nhập
          </a>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="/register">
            Đăng Ký
          </a>
        </li>
        @else
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->name}} <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="{{ route('user.profle') }}">Thông tin tài khoản</a>
            <a class="dropdown-item" href="#">Số dư:  {{ Auth::user()->money_1 }} đ</a>
            <a class="dropdown-item" href="#">Tạm giữ:  {{ Auth::user()->tam_giu }} đ</a>
            <a class="dropdown-item" href="#">Tài khoản 2:  {{ Auth::user()->money_2 }} đ</a>
            <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('logout') }}" 
        onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
          </div>
        </li>
        @endif
      </ul>

    </nav>
    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        
        <li class="nav-item">
          <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Trang chủ</span>
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('nap-the') }}">
              <i class="fas fa-fw fa-table"></i>
              <span>Nạp thẻ</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('mua-the.index') }}">
              <i class="fas fa-fw fa-table"></i>
              <span>Mua Thẻ</span></a>
          </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('nap-tien.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Nạp tiền</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('nap-the.history-card') }}">
              <i class="fas fa-fw fa-chart-area"></i>
              <span>Lịch sử</span></a>
          </li>
       
        <li class="nav-item">
          <a class="nav-link" href="{{ route('rut-tien') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Rút tiền</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('chuyen-tien.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Chuyển tiền</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('frame.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Tích hợp vào website </span></a>
        </li>
      
       
        @if(Auth::user())
          @if(Auth::user()->is_Admin > 1)
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Administrator</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a class="dropdown-item" href="{{ route('admin.danh-sach-the-cao') }}">Danh sách thẻ nạp</a>
                <a class="dropdown-item" href="{{ route('admin.danh-sach-rut-tien') }}">Danh sách rút tiền</a>
                <a class="dropdown-item" href="{{ route('admin.nap-tien') }}">Danh sách nạp tiền</a>
                <a class="dropdown-item" href="{{ route('admin.mua-the') }}">Danh sách mua thẻ</a>
              </div>
            </li>
          @endif
          @endif
    
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">
          <div class="">
              <h4 class="text-success">Thông báo từ Admin</h4>
          </div>
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/">Trang Chủ</a>
            </li>
            <li class="breadcrumb-item active">@yield('title')</li>
          </ol>

          <!-- Page Content -->
        
          <hr>
         @yield('content')

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Your Website 2018</span>
            </div>
          </div>
        </footer>

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
            <a class="btn btn-primary" href="/">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin.min.js') }}"></script>

  </body>

</html>
