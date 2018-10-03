@extends('master')
@section('title')
    Home
@endsection
@section('content')
<div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-comments"></i>
              </div>
              <div class="mr-5">
                @if(!Auth::guest())
                <a style="color:#fff !important;" href="{{ route('nap-the') }}">NẠP THẺ CÀO</a>
                @else 
                  <a style="color:#fff !important;" onclick="notice()" href="#">NẠP THẺ CÀO</a>
                @endif
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-right">
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-list"></i>
              </div>
              <div class="mr-5"> <a style="color:#fff;" href="">NẠP BẰNG ẢNH</a></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-right">
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
              <div class="mr-5"><a href="" style="color:#fff;">MUA THẺ CÀO</a></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-right">
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
              <div class="mr-5"><a href="" style="color:#fff">MUA THẺ GAME</a></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-right">
              </span>
            </a>
          </div>
        </div>
      </div>
      <script>
        function notice() {
          confirm("Vui lòng đăng nhập")
        }
      </script>

@endsection
