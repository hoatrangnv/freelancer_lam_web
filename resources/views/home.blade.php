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
                <a style="color:#fff !important;" href="{{ route('nap-the') }}">NẠP THẺ</a>
                @else 
                  <a style="color:#fff !important;" onclick="notice()" href="#">NẠP THẺ </a>
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
              <div class="mr-5"> 
                  @if(!Auth::guest())
                      <a style="color:#fff;" href="{{ route('chuyen-tien.index') }}">CHUYỂN TIỀN</a>
                @else 
                    <a style="color:#fff !important;" onclick="notice()" href="#">CHUYỂN TIỀN </a>
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
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5">
                  @if(!Auth::guest())
                  <a style="color:#fff;" href="{{ route('rut-tien') }}">RÚT TIỀN</a>
                  @else 
                      <a style="color:#fff !important;" onclick="notice()" href="#">RÚT TIỀN </a>
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
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-life-ring"></i>
              </div>
              <div class="mr-5">
                  @if(!Auth::guest())
                  <a style="color:#fff;" href="{{ route('nap-tien.index') }}">NẠP TIỀN</a>
                  @else 
                      <a style="color:#fff !important;" onclick="notice()" href="#">NẠP TIỀN </a>
                  @endif
              </div>
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
          <div class="col-md-12">
              <div class="panel panel-default panel-table">
                  <div class="panel-heading">
                      <h4>Nạp thẻ không cần đăng nhập</h4>
                      <p class="text-danger">* Nếu bạn quên id frame, vui lòng đăng nhập và vào phần <strong>Tích hợp vào website</strong> để lấy id frame</p>
                      <div class="tools"><span class="icon mdi mdi-download"></span><span class="icon mdi mdi-more-vert"></span></div>
                  </div>
               
              <table class="table table-condensed table-hover table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>Frame</th>
                          <th>Loại Thẻ</th>
                          <th>Mệnh giá</th>
                          <th>Pin</th>
                          <th>Serial</th>
                          <th>Hành động</th>
                      </tr>
                  </thead>
                  <tbody>
                      <form action="http://127.0.0.1:8000/frame/create" method="GET">
                        <tr>
                            <td class="number" style="width: 20%;">
                               <input type="text" placeholder="Nhập vào frame id" class="form-control">
                            </td>
                            <td class="number" style="width: 20%;">
                                <select class="form-control" name="" id="" class="">
                                  @foreach ($card as $value)
                                    <option value="{{ $value->card_code }}">{{ $value->card_name }}</option>   
                                  @endforeach
                                  </select>
                            </td>
                            <td class="number" style="width: 20%;">
                                <select required class="form-control" name="card_price">
                                    <option value="10000">10.000&nbsp;₫</option>
                                    <option value="20000">20.000&nbsp;₫</option>
                                    <option value="30000">30.000&nbsp;₫</option>
                                    <option value="50000">50.000&nbsp;₫</option>
                                    <option value="100000">100.000&nbsp;₫</option>
                                    <option value="200000">200.000&nbsp;₫</option>
                                    <option value="300000">300.000&nbsp;₫</option>
                                    <option value="500000">500.000&nbsp;₫</option>
                                    <option value="1000000">1.000.000&nbsp;₫</option>
                                 </select>
                            </td>
                            <td>
                              <input type="text" name="pin" placeholder="Nhập vào mã pin" class="form-control">
                            </td>
                            <td>
                              <input type="text" name="serial" placeholder="Nhập vào số serial" class="form-control">
                            </td>
                            <td class="number" style="width: 5%;">
                                <button class="btn btn-primary">Nạp</button>
                            </td>
                        </tr>
                    </form>
                  </tbody>
              </table>
          </div>
        </div>
      </div>
      <br>
      <hr>
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
      <br>
     
      <script>
        function notice() {
          confirm("Vui lòng đăng nhập")
        }
      </script>

@endsection
