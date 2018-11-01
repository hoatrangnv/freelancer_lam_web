@extends('master')
@section('title')
    Lịch sử nạp thẻ
@endsection
@section('content')
<div class="row" >
        <div class="col-md-12">
          <h4>Thẻ chờ duyệt </h4>
		  <div class="table-responsive">

             <table class="table table-sm" style="margin-bottom:3em"id="lichsu">
                <thead>
                    <tr>
                        <th>Loại Thẻ</th>
                        <th>Mã Pin - Seria</th>
                        <th>Ảnh</th>
                        <th>Mệnh giá</th>
                        <th>Thực nhận</th>
                        <th>Thời gian</th>
                        <th>Nguồn nạp</th>
                        <th>MGD Notes</th>
                        <th>Trạng Thái</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hsitory as $item)
                    <form action="{{ route('delete-card') }}" method="GET">
                        <input type="hidden" value="{{ $item->payment_id }}" name="id" id="id">
                        <tr>
                                <td>{{ $item->card_name }}</td>
                                <td>PIN: {{ $item->pin }}<br/>SERI: {{ $item->serial }}</td>
                                <td>
								@if($item->is_image == 0)  
                                         <img src="{{ asset($item->image_url) }}" style="width:150px;" alt="">
                                        @else                                           
                                        @endif					
								
								
								</td>
                                <td>{{ number_format($item->price) }} đ</td>
                                <td>

                                @if($item->link_id > 0)  

                                {{number_format($item->price - (($item->price * ($item->rate + $item->chiet_khau_frame))/100))}} đ                                         
                                @else 
                                {{number_format($item->price - (($item->price * ($item->rate - $item->member))/100))}} đ 
                                @endif


                                <!--{{  number_format($item->price - (($item->price * ($item->rate - $item->level))/100)) }} đ-->
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                        @if($item->link_id > 0)  
                                         <span class="text-primary">Mã nhúng {{ $item->link_id }} </span>
                                        @else 
                                         <span class="label label-success">Trực tiếp</span>
                                        @endif
                                    </td>

                                <td>{{ $item->transaction_id }} {{ $item->notes }}</td>
                                <td> 
                                        @switch($item->payment_status)
                                        @case(0)  
                                            <span class="label label-warning">Chờ duyệt</span>
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
                                    @if($item->payment_status == 0)
                                    <button type="submit" class="btn btn-sm btn-danger">Hủy</button>
                                    @endif
                                </td>
                            </tr>
                        </form>
                    @endforeach        
                    
                </tbody>
            </table>
        <br>
         </div> 
		 </div>     
    </div> 
    <div style="float: right;margin-top:5%"class="text-center">{{ $hsitory->links() }}</div>

@endsection