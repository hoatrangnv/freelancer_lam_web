@extends('master')
@section('title')
    Nạp Thẻ Cào
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <br>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <form action="{{ route('nap-card') }}" method="post" >
                    @csrf
                    <input name="user_id" type="hidden" value=" {{ Auth::user()->id}}">
                    <input name="user_phone" type="hidden" value=" {{ Auth::user()->phone_number}}">
                <div class="form-group">
                  <label for="formGroupExampleInput">Loại Thẻ</label>
                    <select name="card_type" class="form-control" id="card_type" onchange="cardDiscount(this)"  required>
                        @foreach($result as $key)
                            <option  value="{{ $key->card_code }}">{{ $key->card_name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput2">Mã Pin</label>
                  <input required type="text" class="form-control" name="card_pin" id="" placeholder="Mã Pin">
                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput2">Mã Seria</label>
                  <input required type="text" class="form-control"name="card_seria" id="" placeholder="Mã Seria">
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
                <button type="submit" class="btn btn-primary">Nạp thẻ</button>
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
                                    <th class="number">Phí</th>
                                    <th class="number">Trạng thái</th>
                                 </tr>
                              </thead>
                              <tbody class="no-border-x">
                                 <tr>
                                    <td>1</td>
                                    <td>Viettel</td>
                                    <td class="number">37%</td>
                                    <td class="number"><span class="label label-success">Hoạt động</span></td>
                                 </tr>
                                 <tr>
                                    <td>2</td>
                                    <td>Vinaphone</td>
                                    <td class="number">39%</td>
                                    <td class="number"><span class="label label-success">Hoạt động</span></td>
                                 </tr>
                                 <tr>
                                    <td>3</td>
                                    <td>Vietnamobile</td>
                                    <td class="number">14%</td>
                                    <td class="number"><span class="label label-warning">Bảo trì</span></td>
                                 </tr>
                                 <tr>
                                    <td>4</td>
                                    <td>Gate</td>
                                    <td class="number">13%</td>
                                    <td class="number"><span class="label label-warning">Bảo trì</span></td>
                                 </tr>
                                 <tr>
                                    <td>5</td>
                                    <td>Zing</td>
                                    <td class="number">14%</td>
                                    <td class="number"><span class="label label-warning">Bảo trì</span></td>
                                 </tr>
                                 <tr>
                                    <td>6</td>
                                    <td>Mobifone</td>
                                    <td class="number">45%</td>
                                    <td class="number"><span class="label label-success">Hoạt động</span></td>
                                 </tr>
                                 <tr>
                                    <td>7</td>
                                    <td>Garena</td>
                                    <td class="number">39%</td>
                                    <td class="number"><span class="label label-success">Hoạt động</span></td>
                                 </tr>
                                 <tr>
                                    <td>8</td>
                                    <td>Vcoin</td>
                                    <td class="number">14%</td>
                                    <td class="number"><span class="label label-warning">Bảo trì</span></td>
                                 </tr>
                                 <tr>
                                    <td>9</td>
                                    <td>Xcoin</td>
                                    <td class="number">10%</td>
                                    <td class="number"><span class="label label-warning">Bảo trì</span></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
        </div>
    </div>
    <script>
        function cardDiscount(selected){
            var a = selected.value;
        }
    </script>
@endsection