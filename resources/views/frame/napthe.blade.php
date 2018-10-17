@extends('master')
@section('title')
    Tích hợp vào website
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
                <table class="table table-condensed table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                                <th>Số tiền</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="http://127.0.0.1:8000/frame/create" method="GET"></form>
                            <input type="hidden" name="_token" value="MkcuR1TaWMqBYpiSzKSuXPnAGTS56fP9v5BDYuVt">
                            <tr>
                                <td style="width: 3%;">#</td>
                                <td class="number">
                                    <input type="text" class="form-control input-sm" name="title" placeholder="Nhập tiêu đề" required="">
                                </td>
                                <td class="number" style="width: 60%;">
                                    <input type="text" name="content" class="form-control input-sm" placeholder="Nội dung trả về khi nạp thẻ thành công" required="">
                                </td>
                                <td class="number" style="width: 10%;">
                                        <select required class="form-control" name="card_price">
                                                <option value="10000">10.000&nbsp;₫</option>
                                                <option value="20000">20.000&nbsp;₫</option>
                                                <option value="30000">30.000&nbsp;₫</option>
                                                <option value="50000">50.000&nbsp;₫</option>
                                                <option value="100000">100.000&nbsp;₫</option>
                                                <option value="200000">200.000&nbsp;₫</option>
                                                <option value="300000">300.000&nbsp;₫</option>
                                                <option value="500000">500.000&nbsp;₫</option>
                                                <option value="1000000">1.000.000&nbsp;₫</option>
                                             </select>
                                </td>
                                <td class="number" style="width: 5%;">
                                    <button class="btn btn-primary">Tạo mới</button>
                                </td>
                            </tr>
                    
                        </tbody>
                    </table>
        </div>
    </div>
@endsection