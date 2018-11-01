@extends('master')
@section('title')
    Lịch sử nạp thẻ
@endsection
@section('content')
<div class="row" >
        <div class="col-md-12">
          <h4>Thẻ chờ duyệt </h4>

             <table class="table table-sm" style="margin-bottom:3em"id="lichsu">
                <thead>
                    <tr>
                        <th>Loại Thẻ</th>
                        <th>Mã Pin</th>
                        <th>Mã Seria</th>
                        <th>Mệnh giá</th>
                        <th>Thực nhận</th>
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
                                <td>{{ $item->pin }}</td>
                                <td>{{ $item->serial }}</td>
                                <td>{{ number_format($item->price) }} đ</td>
                                <td>{{  number_format($item->price - (($item->price * ($item->rate - $item->level))/100)) }} đ</td>
                                <td> 
                                        @switch($item->payment_status)
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
    <div style="float: right;margin-top:5%"class="text-center">{{ $hsitory->links() }}</div>

@endsection