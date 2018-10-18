<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
<body>
        <div class="row">
                <div class="col-md-6 col-md-offset-3" style="margin:0 auto;padding:0;width:100%;text-align:center" >
                    <h4 class="text-center">Thông tin nạp thẻ</h4>
                    <p class="text-success">{{ $mess }}</p>
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th>Loại thẻ</th>
                                <th>Mệnh giá</th>
                                <th>Frame ID</th>
                                <th>Số tiền trong frame</th>
                                <th>Người nhận</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>{{ $card_name }}</td>
                                    <td>{{ number_format($result->price)}} đ</td>
                                    <td>{{ $result->link_id }}</td>
                                    <td>{{ number_format($price_of_link)}} đ</td>
                                    <td>{{ $username }}</td>
                               </tr>
                        </tbody>
                    </table>
                    button type="button" onclick="goBack()" class="btn btn-sm btn-info">Quay lại</a>
                </div>
        </div>
</body>
</html>