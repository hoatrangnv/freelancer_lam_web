@extends('master')
@section('title')
   User Account
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
                <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Tài khoản chính</th>
                                <th>Tài khoản phụ</th>
                                <th>Tạm giữ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                               <td>{{ Auth::user()->id }}</td>
                               <td>{{ Auth::user()->name }}</td>
                               <td>{{ Auth::user()->phone_number }}</td>
                               <td>{{ Auth::user()->email }}</td>
                               <td>{{ number_format(Auth::user()->money_1) }} đ </td>
                               <td>{{ number_format(Auth::user()->money_2) }} đ</td>
                               <td>{{ Auth::user()->tam_giu }}</td>
                            </tr>
                        </tbody>
                    </table>
        </div>
    </div>    
    

    <br>
    <hr>
      
        
          <br>
            <div class="row _padding">
               <div class="col-md-12">
                    <h4>Rút Tiền</h4>
               </div>
               <div class="col-md-6">
                    <form action="" method="POST">
                            @csrf
                            <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Số Tài Khoản (Nhập vào số tài khoản nhận tiền )</label>
                                <input type="number" class="form-control" name="money_rut" id="money_rut"  required />
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Chọn ngân hàng</label>
                                <select class="form-control" name="back_type" id="back_type">
                                    <option value="">Chọn ngân hàng</option>
                                </select>
                            </div>
                            <button type="submit" class="btn-sm btn btn-success">Thêm Tài Khoản</button>
                    </form>
               </div>
               <div class="col-md-6">
                    <form action="{{ route('rut-tien') }}" method="POST">
                            @csrf
                            <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Số tiền</label>
                                <input type="number" class="form-control" name="money_rut" id="money_rut"  required />
                            </div>
                            <div class="form-group">
                                    <label for="formGroupExampleInput">Chọn ngân hàng đăng ký</label>
                                    <select class="form-control" name="back_user" id="back_user">
                                        <option value="">fà</option>
                                    </select>
                                </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Mật Khẩu Cấp 2</label>
                                <input type="password" class="form-control" name="password2_rut" id="password2_rut"  required />
                            </div>
                            <button type="submit" class="btn-sm btn btn-primary">Rút Tiền</button>
    
                    </form>
               </div>
          
            </div>   
        <div class="row">
                <div class="col-md-12" >
                    <h2>Lịch sử giao dịch</h2>
                    <table class="table table-striped "style="overflow-y: scroll">
                        <thead>
                            <tr>
                                    <th>ID</th>
                                    <th>Mã Pin</th>
                                    <th>Mã Seria</th>
                                    <th>Loại Thẻ</th>
                                    <th>Giá Tiên</th>
                                    <th>Người Nạp</th>
                                    <th>Ảnh</th>
                                    <th>Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($result))
                                @foreach ($result as $value)
                                    <tr>
                                        <td>{{ $value->payment_id }}</td>
                                        <td>{{ $value->pin }}</td>
                                        <td>{{ $value->serial }}</td>
                                        <td>{{ $value->card_name }}</td>
                                        <td>{{ number_format($value->price) }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td> <img src="{{ asset($value->image_url) }}" style="width:150px;" alt=""></td>
                                        <td>
                                                @switch($value->payment_status)
                                                @case(0)  
                                                    <button class="btn btn-sm btn-primary">Chờ duyệt</button>
                                                @break
                                                @case(1)
                                                    <button class="btn  btn-sm btn-info">Đang xử lý</button>
                                                @break
                                                @case(2)
                                                    <button class="btn  btn-sm btn-success">Thành công</button>
                                                @break
                                                @case(3)
                                                    <button class="btn  btn-sm btn-danger">Hủy</button>
                                                @break
                                                @case(4)
                                                    <button class="btn  btn-sm btn-danger">Thẻ sai</button>
                                                @break
                                                @case(5)
                                                    <button class="btn  btn-sm btn-warning">Bảo trì</button>
                                                @break
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="float: right;margin-top:5%"class="text-center">{{ $result->links() }}</div>
    </div>
    
    <script>
        
       

      

        this.ListAllBank();

        //get all bank
        function ListAllBank() {
            var arr = [];
            $.ajax({
                url: "{{ route('api.bank') }}",
                type: "get",
                dateType: "text",
                success: function(result) {
                    var htmlResult = "";
                    Object.keys(result).forEach(function(key) {
                        var bank_name = result[key].bank_name;
                        var bank_id = result[key].bank_id;
                        htmlResult += "<option value='"+bank_id+"'>" + bank_name +"</option>"
                    })
                    $("#back_type").append(htmlResult);
                }
            });
        }
        //get only bank
        function getOnlyBank()
        {
            
        }
    </script>
@endsection