@extends('master')
@section('title')
    Dach Sách Nạp Tiền
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
            <h4>Lịch sử nạp tiền</h4>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Mã giao dịch</th>
                        <th>Số tiền</th>
                        <th>Trạng thái</th>
                        <th>Thời gian</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $value)
                    <form action="" method="POST">
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
                            <td>
                                {{ $value->created_at }}
                            </td>
                            <td>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Chấp nhận</option>
                                    <option value="3">Hủy</option>
                                </select>
                            </td>
                        </tr>
                    </form>
                    @endforeach
                    
                </tbody>
            </table>
            {{ $result->links() }}
    </div>
</div>
@endsection