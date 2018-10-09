@extends('master')
@section('title')
    Dach Sách Rút Tiền
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-sm">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Số tiền</th>
                    <th>Ngân hàng</th>
                    <th>Chi nhánh</th>
                    <th>Số TK</th>
                    <th>Trạng Thái</th>
                    <th>Hành động</th>
                </tr>
                @foreach ($result as $value)
                    <tr>
                        <td>{{ $value->widthraw_id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->amount }}</td>
                        <td>{{ $value->bank_name }}</td>
                        <td>{{ $value->bank_branch }}</td>
                        <td>{{ $value->bank_branch }}</td>
                        <td>{{ $value->withdraw_status }}</td>
                        <td>
                            <select  class="form-controll" name="" id="">
                                <option value="1">Chấp Nhận</option>
                                <option value="2">Hủy</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
            <div style="float: right;margin-top:5%"class="text-center">{{ $result->links() }}</div>
       
            </table>
        </div>
    </div>
@endsection