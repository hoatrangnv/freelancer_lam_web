<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
<body>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            @if(session()->has('message'))
              <div class="alert alert-success">
                  {{ session()->get('message') }}
              </div>
          @endif
            @if(session()->has('error'))
              <div class="alert alert-danger">
                  {{ session()->get('error') }}
              </div>
          @endif
              <br>
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <h4>Nạp thẻ không cần đăng nhập</h4>
                    <p class="text-danger">* Nếu bạn quên id frame, vui lòng đăng nhập và vào phần <strong>Tích hợp vào website</strong> để lấy id frame</p>
                    <div class="tools"><span class="icon mdi mdi-download"></span><span class="icon mdi mdi-more-vert"></span></div>
                </div>
            <div class="table-responsive">
             
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
                    <form action="{{ route('frame.createPayment') }}" method="POST" >
                      @csrf
                    <input type="hidden" name="nap_the" value="3">
                      <tr>
                          <td class="number" style="width: 20%;">
                             <input type="number" name="link_id" placeholder="Nhập vào frame id" class="form-control" value="{{ $result->id }}" readonly>
                          </td>
                          <td class="number" style="width: 20%;">
                              <select class="form-control" name="card_type" id="card_type" class="" required>
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
                            <input type="number" name="card_pin" placeholder="Nhập vào mã pin" class="form-control" required>
                          </td>
                          <td>
                            <input type="number" name="card_seria" placeholder="Nhập vào số serial" class="form-control" required>
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
    </div>

</body>
</html>
