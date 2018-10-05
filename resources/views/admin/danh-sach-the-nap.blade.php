@extends('master')
@section('title')
    Dach Sách Thẻ Nạp
@endsection
@section('content')
    <div class="row">
       
        <div class="col-md-12">
                <table class="table table-striped table-sm  ">
                        <thead class="thead-inverse|thead-default">
                            <tr>
                                <th>ID</th>
                                <th>Mã Pin</th>
                                <th>Mã Seria</th>
                                <th>Loại Thẻ</th>
                                <th>Giá Tiên</th>
                                <th>Người Nạp</th>
                                <th>Ghi Chú</th>
                                <th>Trạng Thái</th>
                                <th>Hành Động</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($result as $value)
                                <form action="{{ route('admin.addcard') }}" method="post">
                                    @csrf
                                    <input name="card_id" type="hidden" value="{{ $value->card_id }}">
                                    <input name="user_id" type="hidden" value="{{ $value->order_id }}">
                                <tr>
                                    <td>{{ $value->card_id }}</td>
                                    <td>{{ $value->card_pin }}</td>
                                    <td>{{ $value->card_serial }}</td>
                                    <td>
                                      {{ $value->card_name }}
                                    </td>
                                    <td>{{ number_format($value->card_price) }} đ</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->card_notes }}</td>
                                    <td>
                                            @switch($value->card_delivered)
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
                                                    <button class="btn  btn-sm btn-warning">Bảo trì</button>
                                                @break
                                            @endswitch

                                    </td>
                                    <td>
                                        <select class="form-control" name="status" id="status" onchange="this.form.submit()">
                                            <option value="0">Chấp nhận</option>
                                            <option value="1">Cộng tiền</option>
                                            <option value="2">Hủy</option>
                                            <option value="3">Thẻ sai</option>
                                            <option value="4">Xóa</option>
                                        </select>
                                    </td>
                                </tr>
                            </form>
                               @endforeach
                            </tbody>
                    </table>
        </div>
    </div>
    <script>
     
    </script>
@endsection