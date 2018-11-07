<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nạp thẻ</title>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-128077888-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-128077888-1');
	</script>

    <!-- Bootstrap core CSS-->
    <!-- Bootstrap core CSS-->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container" style="padding-left:10%;padding-right: 10%">
            <div class="row">
                    <div class="col-md-6 col-xs-12 col-sm-12">
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
                                <!-- <h4>Nạp thẻ không cần đăng nhập</h4>
                                <p class="text-danger">* Nếu bạn quên id frame, vui lòng đăng nhập và vào phần <strong>Tích hợp vào website</strong> để lấy id frame</p> -->
                             
                                <form action="{{ route('frame.createPayment') }}" method="POST" >
                                  @csrf
                                    <input type="hidden" name="nap_the" value="3">
                                    <div class="form-group row">
                                            <input type="hidden" name="link_id" id="link_id" placeholder="Nhập vào frame id" class="form-control" value="{{ $result->id }}" readonly>
                                     
                                    </div>
                                    <div class="form-group row">
                                        <span>{{ $result->title1 }}</span>
                                    </div>
                                    <div class="form-group row">
                                        <!--<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Loại thẻ</label>-->
                                        <select class="form-control" name="card_type" id="card_type" class="" required>
                                                @foreach ($card as $value)
                                                    <option value="{{ $value->card_code }}">{{ $value->card_name }}</option>   
                                                @endforeach
                                        </select>
                                    </div>
                                  
                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-8 col-form-label col-form-label-sm">Số điện thoại</label>
                                        <input type="number" class="form-control" value="" placeholder="Nhập vào sđt của bạn" name="phone" required>
                                    </div>
                                    <div class="form-group row">
                                            <!--<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Mệnh giá</label>-->
            
                                            <select required class="form-control" name="card_price">
                                              <option value="10000">10.000&nbsp;₫</option>
                                              <option value="20000">20.000&nbsp;₫</option>
                                              <option value="30000">30.000&nbsp;₫</option>
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
                                            <input type="number" name="card_pin" placeholder="Nhập vào mã pin" class="form-control" required>
                                    </div>
                                    <div class="form-group row">
                                            <!--<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Mã Serial</label>-->
                                            <input type="number" name="card_seria" placeholder="Nhập vào số serial" class="form-control" required>
                                    </div>
                                    <div class="form-group row">
                                          <span>{{ $result->title2 }}</span>
                                    </div>
                                    <button class="btn btn-primary" style="color:{{ $result->color }};background-color:{{ $result->background }}">
                                            @if(empty($result->text)) 
                                                    Nạp thẻ
                                            @else
                                                {{ $result->text }}
                                            @endif        
                                    </button>
                              </form>
                              <br>
                  </div>
                  <div class="col-md-6 col-xs-12 col-sm-12">
                    <br>
                    <h4 class="text-center">Thông tin nạp thẻ</h4>
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                   
                    <p class="text-danger">Nhập vào số điện thoại, bạn vừa nhập ở phần nạp tiền, để kiểm tra trạng thái thẻ nạp</p>
                       <div class="text-center">
                            <input type="number" name="phone_number" class="form-controll" id="phone_number" placeholder="Nhập vào số điện thoại" required>
                            <button type="button"  onclick="search()" class="btn-primary">Search</button>
                       </div>

                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Kết quả</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Lịch sử</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">DS Thẻ</a>
                                <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">Thông tin</a>
                            </div>
                        </nav>
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <p class="text-center"  id="ketqua"></p>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="text-left" id="log_title"></div>
                 
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table table-sm table-bordered">
                                        <tr><th>Mã pin</th><th>Mã serial</th><th>Giá</th><th>Trạng thái</th></tr>
                                        <tbody  id="log_payment"></tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                            </div>
                        </div>
                  </div>
            </div>
</body>
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
</script>
</html>
