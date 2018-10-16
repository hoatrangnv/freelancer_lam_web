@extends('master')
@section('title')
    Dach Sách Nạp Tiền
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
            <h4>Lịch sử nạp tiền</h4>
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Mã giao dịch</th>
                        <th>Số tiền</th>
                        <th>Trạng thái</th>
                        <th>Tài khoản</th>
                        <th>Thời gian</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $value)
                    <form action="{{ route('admin.xac-nhan-nap') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $value->id }}">
                        <input type="hidden" name="user_id" value="{{ $value->user_id }}">
                        <input type="hidden" name="money_1" value="{{ Auth::user()->money_1 }}">
                        <input type="hidden" name="deposit_amount" value="{{ $value->deposit_amount }}">
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ number_format($value->deposit_amount) }} đ</td>
                            <td>
                                @if($value->deposit_status == 0)
                                    <span class="text-info">Đang chờ</span>
                                @elseif($value->deposit_status == 1) 
                                <span class="text-success">Nạp Thành Công</span>
                                @elseif($value->deposit_status == 3) 
                                <span class="text-danger">Hủy</span>
                                
                                @endif
                            </td>
                            <td>{{ $value->user_name }}</td>
                            <td>
                                {{ $value->created_at }}
                            </td>
                            <td>

                                @if($value->deposit_status == 1 || $value->deposit_status == 3)
                                    <button disabled class="btn btn-sm btn-success" style="width:100px; display:inline">Chấp nhận</button>
                                    <button disabled class="btn btn-sm btn-danger">Hủy</button>
                                @elseif($value->deposit_status == 0)    
                                    <button  class="btn btn-sm btn-success" style="width:100px; display:inline" value="1" name="status">Chấp nhận</button>
                                    <button class="btn btn-sm btn-danger" value="3" name="status">Hủy</button>
                                @endif
                            </td>
                        </tr>
                    </form>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
            {{ $result->links() }}
    </div>
</div>
<script>
    var a = "fàa";
    var b = "fàa";
   
    console.log(a === b)
</script>
@endsection