@extends('master')
@section('title')
    Mua Thẻ
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    <h4>Mua thẻ cào</h4>
    <br>
   
    <form action="{{ route('mua-the.buy-card') }}" method="post" >
            @csrf
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="member" id="member" value="{{ Auth::user()->member }}">
        <div class="form-group">
          <label for="formGroupExampleInput">Loại Thẻ</label>
            <select name="card_type" class="form-control" id="card_type" onchange="cardDiscount(this)"  required>
                @foreach($result as $key)
                <option  value="{{ $key->card_code }}">{{ $key->card_name }}</option>
              @endforeach
            </select>

        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Mệnh giá</label>
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
          </div>
        <div class="form-group">
          <label for="formGroupExampleInput2">Số lượng</label>
          <input required type="number" class="form-control"name="qty" id="qty" value="1" placeholder="Số lượng">
        </div>
       
        <button type="submit" class="btn-sm btn btn-primary">Nạp thẻ</button>
      </form>
      <br>
</div>
<div class="col-md-6">
    <div class="panel panel-default panel-table">
        <h4>Phí đổi thẻ</h4>
         <div class="panel-body">
            <table class="table table-striped table-borderless">
               <thead>
                  <tr>
                     <th>TT</th>
                     <th>Nhà mạng</th>
                     <th>Phí</th>
                     <th>Trạng thái</th>
                  </tr>
               </thead>
               <tbody class="no-border-x">
                 @foreach ($card as $value)
                    <tr>
                        <td>{{ $value->cat_id }}</td>
                        <td>{{ $value->card_name }}</td>
                        <td>{{ $value->card_discount }} %</td>
                        <td>
                          @if($value->card_status == 1)
                            <span class="label label-success">Hoạt động</span>
                          @else 
                            <span class="label label-warning">Bảo trì</span>
                          @endif
                        </td>
                    </tr>
                 @endforeach
                 
               </tbody>
            </table>
         </div>
      </div>
</div>
</div>
{{--  //history  --}}
<div class="row">
    <div class="col-md-12">
        <h4>Lịch sử mua thẻ</h4>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Loại Thẻ</th>
                    <th>Mệnh giá</th>
                    <th>Số lượng</th>
                    <th>Trạng Thái</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
@endsection