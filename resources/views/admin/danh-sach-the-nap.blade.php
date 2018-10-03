@extends('master')
@section('title')
    Dach Sách Thẻ Nạp
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
                <table class="table table-bordered table-sm  ">
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
                                <tr>
                                    <td>{{ $value->card_id }}</td>
                                    <td>{{ $value->card_pin }}</td>
                                    <td>{{ $value->card_serial }}</td>
                                    <td>{{ $value->card_provider }}</td>
                                    <td>{{ $value->card_price }}</td>
                                    <td>{{ $value->order_id }}</td>
                                    <td>{{ $value->card_notes }}</td>
                                    <td>
                                        @if( $value->card_delivered == 1)
                                            <button type="button" class="btn btn-primary">Chưa xác nhận</button>
                                        @else if($value->card_delivered == 2)
                                            <button class="btn btn-success">Xác nhận</button>
                                        @else if($value->card_delivered == 2)
                                        <button class="btn btn-danger">Hủy</button>

                                        @endif
                                    </td>
                                    <td>
                                        <select class="form-control" name="" id="">
                                            <option value="">Xác nhận</option>
                                            <option value="">Hủy</option>
                                        </select>
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                    </table>
        </div>
    </div>
@endsection