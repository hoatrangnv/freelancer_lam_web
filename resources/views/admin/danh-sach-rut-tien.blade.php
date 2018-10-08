@extends('master')
@section('title')
    Dach Sách Thẻ Nạp
@endsection
@section('content')
    <div class="row">
       
        <div class="col-md-12">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
                <table class="table table-bordered table-sm  ">
                        <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Mã Pin</th>
                                <th>Mã Seria</th>
                                <th>Loại Thẻ</th>
                                <th>Giá Tiên</th>
                                <th>Người Nạp</th>
                                <th>Ảnh</th>
                                <th>Trạng Thái</th>
                                <th>Hành Động</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($result as $value)
                                <form action="{{ route('admin.addcard') }}" method="post">
                                    @csrf
                                  
                                <tr>
                                    <td>gsgs</td>
                                    <td>gsgs</td>
                                    <td>gsgs</td>
                                    <td>gss</td>
                                    <td>gss</td>
                                    <td>gss</td>
                                    <td> 
                                       gsgs
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <select class="form-control" name="status" id="status" onchange="this.form.submit()">
                                            <option value="">Hành động</option>
                                            <option value="1">Đang xử lý</option>
                                            <option value="2">Chấp nhận</option>
                                            <option value="3">Hủy</option>
                                            <option value="4">Thẻ sai</option>
                                            <option value="5">Bảo trì</option>
                                            <option value="6">Xóa</option>
                                        </select>
                                    </td>
                                </tr>
                            </form>
                              
                            </tbody>
                    </table>
        </div>
    </div>
   
   
    <script>
     
    </script>
@endsection