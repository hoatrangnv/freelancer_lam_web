@extends('master')
@section('title')
    Nạp Tiền
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <h4>Nạp Tiền</h4>
        <form action{{ route('nap-tien.nap') }} method="POST">
            @csrf
             <div class="form-group">
                <label for="">Số dư tài khoản</label>
                <input type="text" class="form-control" id="money_old" name="money_old" value="{{ number_format(Auth::user()->money_1 )}} đ">
              </div>
             <div class="form-group">
                <label for="">Số tiền</label>
                <input type="text" class="form-control" id="money_nap" name="money_nap">
              </div>
             <div class="form-group">
                <label for="">Số điện thoại</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number">
              </div>
              <div class="form-group">
                <label for="">Mật khẩu cấp 2</label>
                <input type="password" class="form-control" id="password2" name="password2">
              </div>
              <button type="submit"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Nạp Tiền</button>
        </form>
        <br>
       
    </div>
    <div class="col-md-6">
        <h4>Lịch sử nạp tiền</h4>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Mã giao dịch</th>
                    <th>Số tiền</th>
                    <th>Trạng thái</th>
                    <th>Thời gian</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    
</script>
@endsection