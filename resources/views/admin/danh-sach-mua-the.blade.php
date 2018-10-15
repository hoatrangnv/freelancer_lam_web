@extends('master')
@section('title')
    Dach Sách Mua Thẻ
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
            <table class="table table-sm table-bordered " style="overflow: visible">
                <thead>
                    <th>STT</th>
                    <th>Tài khoản</th>
                    <th>Loại thẻ</th>
                    <th>Chiết khấu</th>
                    <th>Mệnh giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền - Thực nhận</th>
                    <th>Trạng thái</th>
                    <th>Số thẻ</th>
                    <th>Serial</th>
                    <th>Hành động</th>
                </thead>
                <tbody>
                    @foreach ($result as $value)
                        <form action="{{ route('admin.buy-card') }}" method="POST" id="form1">
                            @csrf
                            <input type="hidden" value="{{  $value->buy_id }}" name="buy_id" id="buy_id">
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" value="{{  $value->card_prices }}" name="card_prices" id="card_prices">
                            <input type="hidden" name="money_1" id="money_1" value="{{ Auth::user()->money_1 }}">
                            <input type="hidden" name="tam_giu" id="tam_giu" value="{{ Auth::user()->tam_giu }}">
                            <tr>
                                <td>{{ $value->buy_id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->card_provider_name }}</td>
                                <td>{{ $value->card_discount }} %</td>
                                <td>{{ number_format($value->card_prices) }} đ</td>
                                <td>{{ $value->card_qty }}</td>
                                <td>{{ number_format( $value->card_amount) }} đ</td>
                                <td> @if($value->status == 2)
                                        <span class="text-success">Chấp Nhận</span>
                                    @elseif($value->status == 3) 
                                        <span class="text-danger">Hủy</span>
                                    @else 
                                        <span class="text-info">Chờ</span>
                                    @endif
                                </td>
                                <td>
                                    <input type="number" class="form-controll" name="so_the"  value="{{ $value->card_pin }}"/>
                                </td>
                                <td>
                                    <input type="number" class="form-controll" name="serial" value="{{ $value->card_serial }}"/>
                                </td>
                                <td>
                                    @if($value->status == 2 || $value->status == 3)
                                        <button disabled class="btn btn-sm btn-success" style="width:100px; display:inline">Chấp nhận</button>
                                        <button disabled class="btn btn-sm btn-danger">Hủy</button>
                                    @elseif($value->status == 0)    
                                        <button  class="btn btn-sm btn-success" style="width:100px; display:inline" value="2" name="status">Chấp nhận</button>
                                        <button class="btn btn-sm btn-danger" value="3" name="status">Hủy</button>
                                    @endif
                                </td>
                            </tr>
                        </form>    
                    @endforeach
                    
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <div style="float:right;width:100%;text-align:right">  {{ $result->links() }}</div>
<script>
    
</script>
@endsection