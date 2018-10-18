@extends('master')
@section('title')
    Tích hợp vào website
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
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
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <h4>Tích hợp vào website</h4>
                    <div class="tools"><span class="icon mdi mdi-download"></span><span class="icon mdi mdi-more-vert"></span></div>
                </div>
                <div class="panel-body">
                    <div>
                        <div role="alert" class="alert alert-contrast alert-primary alert-dismissible">
                            <div class="icon"><span class="mdi mdi-info-outline"></span></div>
                            <div class="message">Chú ý : Mục này dùng cho thành viên sử dụng link nạp trực tiếp không cần đăng nhập.
                                <br>- Chức năng cho phép thành viên thông báo thêm nội dung cho người nạp thẻ khi nạp thành công.
                                <br>- Mỗi thành viên có thể tạo nhiều nội dung thông báo, mỗi nội dung có một ID riêng.
                                <br>- Thông báo theo số tiền chỉ dành cho mã nhúng, không có tác dụng với link trực tiếp từ doithe.pro.
                                <br>- Khách hàng của bạn sẽ nhận được thông báo khi nạp thẻ bằng với số tiền khai báo, Để bằng 0 nếu bạn muốn thông báo khi nạp thẻ thành công với bất kỳ mệnh giá. Mặc định là bằng 0, khách của bạn sẽ nhận được thông báo khi nạp thẻ thành công.</div>
                        </div>
                    </div>
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
                            <form action="{{ route('frame.create') }}" method="POST">
                                @csrf
                                <tr>
                                    <td style="width: 3%;">#</td>
                                    <td class="number">
                                        <input type="text" class="form-control input-sm" name="title" placeholder="Nhập tiêu đề" required>
                                    </td>
                                    <td class="number" style="width: 60%;">
                                        <input type="text" name="content" class="form-control input-sm" placeholder="Nội dung trả về khi nạp thẻ thành công" required>
                                    </td>
                                    <td class="number" style="width: 10%;">
                                        <input type="text" name="price" class="form-control input-sm" placeholder="Giá xem" required>
                                    </td>
                                    <td class="number" style="width: 5%;">
                                        <button class="btn btn-primary" >Tạo mới</button>
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>Số tiền</th>
                        <th>Ngày tạo</th>
                        <th>Frame</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $value)
                    <form action="{{ route('frame.updateLink') }}" method="GET">
                        <input type="hidden" value="{{ $value->id }}" name="id">
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td><input name="title" type="text" value="{{ $value->title }}"></td>
                            <td><input name="content" type="text" value="{{ $value->content }}"></td>
                            <td><input name="price" type="text" value="{{ $value->price}}"></td>
                            <td>{{ $value->created_at }}</td>
                            <td></td>
                            <td><button class="btn btn-sm">Cập nhật</button></td>
                        </tr>
                    </form>
                    @endforeach
                   
                </tbody>
            </table>
        </div>
    </div>
@endsection