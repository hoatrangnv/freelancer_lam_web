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
            <div class="table-responsive">
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
                                <th>Nguồn nạp</th>
                                <th>Trạng Thái</th>
                                <th>Hành Động</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($result as $value)
                                <form action="{{ route('admin.addcard') }}" method="post">
                                    @csrf
                                    <input name="payment_id" id="payment_id" type="hidden" value="{{ $value->payment_id }}">
                                    <input name="user_id" type="hidden" value="{{ $value->id }}">
                                    <input name="price" type="hidden" value="{{ $value->price }}">
                                    <input name="member" type="hidden" value="{{ $value->member }}">
                                    <input name="rate" type="hidden" value="{{ $value->rate }}">
                                    <input name="card_name" type="hidden" value="{{ $value->card_name }}">
                                <tr>
                                    <td>{{ $value->payment_id }}</td>
                                    <td>{{ $value->pin }}</td>
                                    <td>{{ $value->serial }}</td>
                                    <td>
                                      {{ $value->card_name }}
                                    </td>
                                    <td>{{ number_format($value->price) }} đ</td>
                                    <td>{{ $value->name }}</td>
                                    <td> 
                                        <img src="{{ asset($value->image_url) }}" style="width:150px;" alt="">
                                    </td>
                                    <td>
                                        @if($value->link_id > 0)  
                                         <span class="text-primary">Frame<br/> {{ $value->phone }} - {{ $value->link_id }} </span>
                                        @else 
                                         <span class="text-success">Website</span>
                                        @endif
                                    </td>
                                    <td>
                                            @switch($value->payment_status)
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
                                                    <button class="btn  btn-sm btn-danger">Thẻ sai</button>
                                                @break
                                                @case(5)
                                                    <button class="btn  btn-sm btn-warning">Bảo trì</button>
                                                @break
                                            @endswitch

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
                               @endforeach
                            </tbody>
                    </table>
            </div>
        </div>
    </div>
    <div style="float: right;margin-top:5%"class="text-center">{{ $result->links() }}</div>
   
    <script>
     
    </script>
@endsection