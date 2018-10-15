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
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ number_format($value->deposit_amount) }} đ</td>
                            <td>
                                @if($value->deposit_status == 0)
                                    <span class="text-info">Đang chờ</span>
                                @else 
                                <span class="text-success">Nạp Thành Công</span>
    
                                @endif
                            </td>
                            <td>{{ $value->user_name }}</td>
                            <td>
                                {{ $value->created_at }}
                            </td>
                            <td>
                                <select name="status" id="status"  onchange="this.form.submit()">
                                    <option selected disabled value="">Hành động</option>
                                    <option value="1">Chấp nhận</option>
                                    <option value="3">Hủy</option>
                                </select>
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
@endsection