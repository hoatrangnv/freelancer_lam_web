@extends('master')
@section('title')
    My search
@endsection
@section('content')

	<div class="container">
		<h1>Tra cứu thẻ</h1>


			<div class="row">
				<div class="col-md-6">
                    <input type="text" name="searchID" id="searchID" class="form-control" placeholder="Search" value="">
				</div>
				<div class="col-md-6">
					<button type="" class="btn btn-success" onclick="search()">Search</button>
				</div>
			</div>


		<table class="table table-bordered">
			<tr>
				<th>Id</th>
				<th>Serial</th>
				<th>Giá</th>
				<th>User ID</th>
				<th>Ngày tạo</th>
                <th>Ngày cập nhật</th>
                <th>Trạng thái</th>
			</tr>
            <tbody id="datatable">

            </tbody>
        </table>
        <p id="mess"></p>
	</div>
    <script>
       function search()
       {
        var text =document.getElementById('searchID').value;
        console.log(text)
        $.ajax({
            url: "{{ route('serial-search') }}",
            data: {
                'searchID':text
            },
            dataType: "text",
            success: function(result) {
                var JSONObject  = JSON.parse(result)
                var dataResult  = JSONObject;
                var html = "";
                Object.keys(dataResult).forEach(function(key) {
                  var checkcode = dataResult.code;
                    console.log(checkcode)

                if(checkcode === 400){
                    $('#datatable').html("")
                    $('#mess').html("").html("Thẻ không tồn tại");
                }
                else {
                    var dataCode = dataResult.data;
                    dataCode.forEach(function(element) {

                          var status = element.status;
                          console.log(status)
                          checkstatus = "";
                          if(status === 0){
                              checkstatus = "Chưa sử dụng";
                          } else if(status === 1 ) {
                              checkstatus = "Đã sử dụng";
                          }
                          html = "<tr><td>"+element.id+"</td><td>"+element.serial+"</td><td>"+element.price.toLocaleString()+"</td><td>"+element.name+"</td><td>"+element.created_at+"</td><td>"+element.updated_at+"</td><td>"+checkstatus+"</td></tr>"
                          $('#datatable').html("").append(html);
                    })
                }
            })}
          });
       }
    </script>
@endsection
