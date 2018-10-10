@extends('master')
@section('title')
   Trang chủ
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
      <br>
      <div class="row">
        <div class="col-md-6">
                <div class="panel panel-default panel-table">
                        <h4>Phí đổi thẻ</h4>
                         <div class="panel-body">
                            <table class="table table-striped table-borderless">
                               <thead>
                                  <tr>
                                     <th>TT</th>
                                     <th>Nhà mạng</th>
                                     <th class="number">Phí</th>
                                     <th class="number">Trạng thái</th>
                                  </tr>
                               </thead>
                               <tbody class="no-border-x">
                                 @foreach ($result as $value)
                                    <tr>
                                        <td>{{ $value->cat_id }}</td>
                                        <td>{{ $value->card_name }}</td>
                                        <td class="number">{{ $value->card_discount }} %</td>
                                        <td class="number">
                                          @if($value->card_status == 1)
                                            <span class="label label-success">Hoạt động</span>
                                          @else 
                                            <span class="label label-warning">Bảo trì</span>
                                          @endif
                                        </td>
                                    </tr>
                                 @endforeach
                                 
                               </tbody>
                            </table>
                         </div>
                      </div>
        </div>
        <div class="col-md-6">
                <div class="panel panel-default panel-table">
                        <h4>Phí mua thẻ</h4>
                         <div class="panel-body">
                            <table class="table table-striped table-borderless">
                               <thead>
                                  <tr>
                                     <th>TT</th>
                                     <th>Nhà mạng</th>
                                     <th class="number">Phí</th>
                                     <th class="number">Trạng thái</th>
                                  </tr>
                               </thead>
                               <tbody class="no-border-x">
                                  @foreach ($result as $value)
                                  <tr>
                                      <td>{{ $value->cat_id }}</td>
                                      <td>{{ $value->card_name }}</td>
                                      <td class="number">{{ $value->card_discount_buy }} %</td>
                                      <td class="number">
                                        @if($value->card_type == 1)
                                          <span class="label label-success">Hoạt động</span>
                                        @else 
                                          <span class="label label-warning">Bảo trì</span>
                                        @endif
                                      </td>
                                  </tr>
                               @endforeach
                               </tbody>
                            </table>
                         </div>
                      </div>
        </div>
      </div>
      <script>
        function notice() {
          confirm("Vui lòng đăng nhập")
        }
      </script>

@endsection
