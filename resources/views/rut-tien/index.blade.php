@extends('master')
@section('title')
  Rút Tiền
@endsection
@section('content')
<div class="row _padding">
        <div class="col-md-6">
               
                @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
                @if(session()->has('thanhcong'))
                    <div class="alert alert-success">
                        {{ session()->get('thanhcong') }}
                    </div>
                @endif
                <h4>Rút tiền</h4>
                <form action="{{ route('withdraw') }}" method="POST">
                        @csrf
                        <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Số tiền</label>
                            <input type="number" class="form-control" name="money_rut" id="money_rut"  required />
                        </div>
                        <div class="form-group">
                                <label for="formGroupExampleInput">Chọn ngân hàng đăng ký</label>
                                <select class="form-control" name="back_user" id="back_user">
                                </select>
                            </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Mật Khẩu Cấp 2</label>
                            <input type="password" class="form-control" name="password2_rut" id="password2_rut"  required />
                        </div>
                        <button type="submit" class="btn-sm btn btn-primary">Rút Tiền</button>
                </form>
        </div>
        <div class="col-md-6">
            
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
             @endif
             <h4>Thêm tài khoản ngân hàng</h4>
             <form action="{{ route('api.add-bank') }}" method="GET">
                    @csrf
                    <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Số Tài Khoản (Nhập vào số tài khoản nhận tiền )</label>
                        <input type="number" class="form-control" name="account_number" id="account_number"  required />
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Tên Chủ Tài Khoản (Nhập vào tên chủ tài khoản thẻ )</label>
                        <input type="text" class="form-control" name="account_name" id="account_name"  required />
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Chọn ngân hàng</label>
                        <select class="form-control" name="back_type" id="back_type" required>
                            <option value="">Chọn ngân hàng</option>
                        </select>
                    </div>
                    <div class="form-group">
                            <label for="formGroupExampleInput">Chi Nhánh</label>
                            <input type="text" class="form-control" name="chi_nhanh" id="chi_nhanh"  required />
                        </div>
                    <button type="submit" class="btn-sm btn btn-success">Thêm Tài Khoản</button>
            </form>
        </div>
   
     </div>  
     <script>
            this.ListAllBank();
            this.getOnlyBank();
    
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
                            var bank_id = result[key].id;
                            htmlResult += "<option value='"+bank_id+"'>" + bank_name +"</option>"
                        })
                        $("#back_type").append(htmlResult);
                    }
                });
            }
            //get only bank
            function getOnlyBank()
            {
                var arr = [];
                $.ajax({
                    url: "{{ route('api.get-bank') }}",
                    type: "get",
                    dateType: "text",
                    success: function(result) {
                        var htmlResult = "";
                        Object.keys(result).forEach(function(key) {
                            var bank_id = result[key].id;
                            var bank_name = result[key].bank_name;
                       
                            htmlResult += "<option value='"+bank_id+"'>" + bank_name +"</option>"
                        })
                        $("#back_user").append(htmlResult);
                    }
                });
            }
        </script>
@endsection