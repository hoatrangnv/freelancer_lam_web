@extends('master')
@section('title')
    Tích hợp vào website
@endsection
@section('content')
    <div class="row">
            <div class="col-md-6 col-md-offset-3" style="margin:0 auto;padding:0;width:100%;text-align:center" >
                <h4 class="text-center">Thông tin nạp thẻ</h4>
                <p class="text-success">{{ $mess }}</p>
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>Loại thẻ</th>
                            <th>Mệnh giá</th>
                            <th>Frame ID</th>
                            <th>Số tiền trong frame</th>
                            <th>Người nhận</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{ $card_name }}</td>
                                <td>{{ number_format($result->price)}} đ</td>
                                <td>{{ $result->link_id }}</td>
                                <td>{{ number_format($price_of_link)}} đ</td>
                                <td>{{ $username }}</td>
                           </tr>
                    </tbody>
                </table>
                <a href="/" class="btn btn-sm btn-info">Quay lại trang chủ</a>
            </div>
    </div>
@endsection