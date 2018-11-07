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
                                <th>Mã</th>
				<!--<th>Mã Seria</th> -->
                                <th>Loại Thẻ</th>
                                <th>Giá Tiền</th>
                                <th>Người Nạp</th>
                                <th>Ảnh</th>
                                <th>Nguồn nạp</th>
                                <th>Trạng Thái</th>
                                <th>Ghi chú</th>
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
                                    <input type="hidden" name="phone" value="{{ $value->phone }}">
                                    <input type="hidden" name="link_id" value="{{ $value->link_id }}">
                                    <input type="hidden" name="chiet_khau_frame" value="{{ $value->chiet_khau_frame }}">
                                <tr>
                                    <td>{{ $value->payment_id }}</td>
                                    <td>Pin: {{ $value->pin }}<br/>
                                    Seria: {{ $value->serial }}</td>
                                    <td>
                                      {{ $value->card_name }}
                                    </td>
                                    <td><span class="btn btn-sm btn-info">{{ number_format($value->price) }} đ</span> <br/> 

				 @if($value->link_id > 0)  

					{{number_format($value->price - (($value->price * ($value->rate + $value->chiet_khau_frame))/100))}} đ                                         
                                        @else 
					{{number_format($value->price - (($value->price * ($value->rate - $value->member))/100))}} đ 
                                        @endif
	 


				 </td>
                                    <td>{{ $value->name }}<br/>{{ $value->phone_number }} {{ $value->money_1 }}</td>
                                    <td> 
									@if($value->is_image == 0)                                           
                                        <img src="{{ asset($value->image_url) }}" style="width:150px;" alt="">
									@else                                           
                                        @endif	
                                    </td>
                                    <td>
                                        @if($value->link_id > 0)  
                                         <span class="text-primary">Mã nhúng {{ $value->link_id }}<br/> </span>  {{ $value->phone }}
                                        @else 
                                         <span class="label label-success">Trực tiếp</span>
                                        @endif
                                    </td>


                                    <td> {{ $value->created_at }} <br/>{{ $value->transaction_id }} {{ $value->notes }}<br/>  {{ $value->notes }} {{ $value->requestId }}  
				    </td>
                                    <td>
                                            @switch($value->payment_status)
                                                @case(0)  
                                                    <span class="label label-blue">Chờ duyệt</span>
                                                @break
                                                @case(1)
                                                    <span class="label label-info">Đang xử lý</span>
                                                @break
                                                @case(2)
                                                    <span class="label label-success">Thành công</span>
                                                @break
                                                @case(3)
                                                    <span class="label label-danger">Hủy</span>
                                                @break
                                                @case(4)
                                                    <span class="label label-danger">Thẻ sai</span>
                                                @break
                                                @case(5)
                                                    <span class="label label-warning">Bảo trì</span>
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