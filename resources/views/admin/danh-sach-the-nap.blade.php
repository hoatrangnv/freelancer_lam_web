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
                                    <td>
                                      {{ $value->card_name }}
                                    </td>
                                    <td>{{ number_format($value->card_price) }} đ</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->card_notes }}</td>
                                    <td>
                                            @switch($value->card_delivered)
                                                @case(1)  
                                                    <button class="btn btn-sm btn-success">Accept</button>
                                                @break
                                                @case(2)
                                                <button class="btn  btn-sm btn-danger">Cancer</button>
                                                @break
                                                @default
                                                  <button type="button" class="btn  btn-sm btn-primary">Pending</button>
                                            @endswitch

                                    </td>
                                    <td>
                                        <select class="form-control" name="" id="">
                                            <option value="">Accept</option>
                                            <option value="">Cancer</option>
                                        </select>
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                    </table>
        </div>
    </div>
@endsection