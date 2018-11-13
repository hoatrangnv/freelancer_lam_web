@extends('master')
@section('title')
    Nạp Tiền
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <h4>Nạp Tiền</h4>
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
        <form action{{ route('nap-tien.nap') }} method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="username" value="{{ Auth::user()->name }}">

            <div class="form-group">
                <label for="">Số dư tài khoản</label>
                <input type="text" class="form-control" id="money_old" name="money_old" value="{{ number_format(Auth::user()->money_1 )}} đ" readonly/>
              </div>
             <div class="form-group">
                <label for="">Số tiền</label>
                <input type="number" class="form-control" id="money_nap" name="money_nap" required/>
              </div>
              <div class="form-group">
                <label for="">Mật khẩu cấp 2</label>
                <input type="password" class="form-control" id="password2" name="password2" required/>
              </div>
              <button type="submit"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Nạp Tiền</button>
        </form>
        <br>
       
    </div>
    <div class="col-md-6">
        <h5>Lịch sử nạp tiền</h5>
		<div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Mã giao dịch</th>
                    <th>Số tiền</th>
                    <th>Trạng thái</th>
                    <th>Thời gian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($result as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ number_format($value->deposit_amount) }} đ</td>
                        <td>
                            @if($value->deposit_status == 0)
                                <span class="label label-blue">Đang chờ</span>
                            @else 
                            <span class="label label-success">Nạp Thành Công</span>

                            @endif
                        </td>
                        <td>
                            {{ $value->created_at }}
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
        {{ $result->links() }}
    </div>
	</div>
</div>
<script>
    
</script>
@endsection