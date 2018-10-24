<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lịch sử nạp thẻ</title>
    <!-- Bootstrap core CSS-->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body style="background:#efeded;flex:1;display:flex;f">
       <div class="container" style="width:600px; height: 350px; border:1px solid #eee;background:#fff;padding-left:5%;padding-right: 5%">
            <div class="row">
                    <div class="col-md-12 col-xs-12" style="margin:0 auto;padding:0;width:100%;text-align:center" >
                        <br>
                        <h4 class="text-center">Thông tin nạp thẻ</h4>
                        <p class="text-success">{{ $mess }}</p>
                        <p class="text-danger">Nhập vào số điện thoại, bạn vừa nhập ở phần nạp tiền, để kiểm tra trạng thái thẻ nạp</p>
                            <input type="hidden" value="{{ $link_id }}" name="link_id" id="link_id">
                            <input type="number" name="phone_number" id="phone_number" placeholder="Nhập vào số điện thoại" required>
                            <button type="button"  onclick="search()" class="btn-primary">Search</button>
                    </div>
            </div>
            <br>
            <div class="row">
                <div style="display:block;width: 100%;">
                    <p class="text-center"  id="iterm2"></p>
                </div>
                <br>
            </div>
       <button onclick="goBack()" class="btn btn-sm btn-primary">Quay lại</button>

       </div>

</body>
<script>
    function goBack() {
        window.history.back();
    }
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
                console.log(result)
                var htmlResult = result;
              
                  $("#iterm2").html(" ").html(htmlResult);
            }
        });
      
       
    }
</script>
</html>