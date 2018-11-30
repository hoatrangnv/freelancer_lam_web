@extends('master')
@section('title')
    Nạp Thẻ
@endsection
@section('content')
    <div class="row">

        <div class="col-md-4">
                @if(session()->has('status'))
                <div class="alert alert-success">
                    {{ session()->get('status') }}
                </div>
            @endif
              @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <h6>Nạp thẻ cào</h6>
            <br>

            <form action="{{ route('xlNaptructiep') }}" method="POST" >
                    @csrf
                      <input type="hidden" name="nap_the" value="3">
                      <div class="form-group row">
                              <input type="hidden" name="user_id" id="user_id" placeholder="Nhập vào frame id" class="form-control" value="{{ Auth::user()->id }}" readonly>

                      </div>

                      <div class="form-group row">
                          <!--<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Loại thẻ</label>-->
                          <select class="form-control" name="card_type" id="card_type" class="" required onchange="checkCardType(this)">
                                  <option value="" selected disabled>Chọn loại thẻ</option>
                                  @foreach ($card as $value)
                                      <option value="{{ $value->card_code }}">{{ $value->card_name }}</option>
                                  @endforeach
                          </select>
                      </div>

                      {{-- <div class="form-group row">
                          <strong  style="color:{{ $result->background }}">Lưu ý: Nếu nhập sai thẻ nhiều lần sẽ bị khóa</strong>
                          <input type="number" class="form-control" value="" placeholder="SĐT nhận kết quả" name="phone" required maxlength="13">
                      </div> --}}
                      <div class="form-group row">
                              <!--<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Mệnh giá</label>-->

                              <select required class="form-control" name="card_price" id="card_price">
                                <option value="50000">50.000&nbsp;₫</option>
                                <option value="100000" selected>100.000&nbsp;₫</option>
                                <option value="200000">200.000&nbsp;₫</option>
                                <option value="300000">300.000&nbsp;₫</option>
                                <option value="500000">500.000&nbsp;₫</option>
                                <option value="1000000">1.000.000&nbsp;₫</option>
                             </select>
                      </div>
                      <div class="form-group row">
                              <!--<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Mã Pin</label>-->
                              <input type="number" name="card_pin" placeholder="Nhập vào mã pin" class="form-control" maxlength="18"  minlength="10" required>
                      </div>
                      <div class="form-group row">
                              <!--<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Mã Serial</label>-->
                              <input type="number" name="card_seria" placeholder="Nhập vào số serial" class="form-control"maxlength="18"  minlength="13"  required>

                              <input type="text" name="getlink" id="getlink" class="form-control" value="<?php  if(isset($_SERVER['HTTP_REFERER'])) { echo $_SERVER['HTTP_REFERER']; } else { echo '0';}?>" style="display:none"/>
                              <input type="text" name="getagent" id="getagent" class="form-control" value="<?php  echo $_SERVER['HTTP_USER_AGENT'];?>" style="display:none"/>
                              <input type="text" name="getlanguage" id="getlanguage" class="form-control" value="<?php  echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];?>" style="display:none"/>
                              <input type="text" name="getip" id="getip" class="form-control" value="<?php  echo $_SERVER['REMOTE_ADDR'];?>" style="display:none"/>


                              <input type="text" name="notes" id="notes" class="form-control" value="" style="display:none"/>
                      </div>

                      <button class="btn btn-primary" style="border:#fff 1px; border-radius:8px;color:;background-color:"> Nạp thẻ</button>
                </form>


        </div>

        <div class="col-md-4">
            <div class="panel panel-default panel-table">
                <h6>Phí đổi thẻ</h6>
                 <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                       <thead>
                          <tr>
                             <th>TT</th>
                             <th>Nhà mạng</th>
                             <th class="number">Chiết khấu</th>
                             <th class="number">Trạng thái</th>
                          </tr>
                       </thead>
                       <tbody class="no-border-x">
                         @foreach ($card as $value)
                            <tr>
                                <td>{{ $value->cat_id }}</td>
                                <td>{{ $value->card_name }}</td>
                                <td class="number">{{ $value->card_discount }}%</td>
                                <td class="number">
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
          <div class="row" >
            <div class="col-md-12">
              <h6>Danh sách thẻ chờ duyệt </h6>
				<div class="table-responsive">
                 <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Loại Thẻ</th>
                            <th>Mã Pin</th>
                            <th>Mã Seria</th>
                            <th>Mệnh giá</th>
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
                                    <td> <span class="label label-blue">Chờ duyệt</span></td>
                                    <td>
                                        <button type="submit" class="btn btn-sm btn-danger">Hủy</button>
                                    </td>
                                </tr>
                            </form>
                        @endforeach

                    </tbody>
                </table>
				</div>
            <br>
             </div>
        </div>

    <script>
        function cardDiscount(selected){
            var a = selected.value;
        }
    </script>
    <script>
            function search()
            {
                var phone_number = document.getElementById('phone_number').value;
                var link_id = document.getElementById('link_id').value;
                $.ajax({
                    url: "{{ route('api.search') }}",
                    type: "get",
                    data:{
                        'phone_number':phone_number,
                        'link_id':link_id
                    },
                    dataType: "text",
                    success: function(result) {
                        var mess = "";
                        var log_title = "";
                        var log_content = "";
                        var JSONObject  = JSON.parse(result)
                          var dataResult  = JSONObject.data;
                          var html = "";

                        //mess
                        Object.keys(dataResult).forEach(function(key) {
                           mess = dataResult.mess;
                           $('#ketqua').html("").html(mess)
                        })
                        var htmlResult = "";
                        var htmlPayment = "";
                        var dataResultLog = JSONObject.data.log;
                        var dataResultPayment = JSONObject.data.payment;

                        //log
                        Object.keys(dataResultLog).forEach(function(key) {
                            console.log(dataResultLog)
                            htmlResult += "<div class='text-left'>"+dataResultLog[key].title+ " " + dataResultLog[key].content+"</div>"

                        })
                        $('#log_title').html("").append(htmlResult);

                        //payment
                        var status_html = "";
                        Object.keys(dataResultPayment).forEach(function(key) {
                            console.log(dataResultPayment)
                            var status = dataResultPayment[key].payment_status;
                            switch(status) {
                                case 0:
                                   status_html = " <span class='label label-blue'>Chờ duyệt</span>"
                                break
                                case 1:
                                status_html = "  <span class='label label-info'>Đang xử lý</span> "
                                break
                                case 2:
                                status_html = "  <span class='label label-success'>Thành công</span> "
                                break
                                case 3:
                                status_html = "  <span class='label label-danger'>Hủy</span>"
                                break
                                case 4:
                                status_html = " <span class='label label-danger'>Thẻ sai</span>"
                                break
                                case 5:
                                status_html = "<span class='label label-warning'>Bảo trì</span>"
                                break
                            }

                            htmlPayment += "<tr> <td>"+ dataResultPayment[key].pin+"</td><td>"+ dataResultPayment[key].serial+ "</td><td>"+dataResultPayment[key].price.toLocaleString()+ "đ"+"</td>"+"<td>"+status_html+"</td></tr>"

                        })
                        $('#log_payment').html("").append(htmlPayment);
                    }
                });


            }

            function checkCardType(selected){
                var cardType = selected.value;
                console.log(cardType)
                if(cardType === 'xcoin'){
                    //disable selec tien
                    $("#card_price").attr('disabled','disabled');
                }else {
                    $("#card_price").removeAttr('disabled');
                }
            }
        </script>
@endsection
