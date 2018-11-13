@extends('master')
@section('title')
    My search
@endsection
@section('content')

	<div class="container">
		<h1>Laravel 5.5 Full Text Search Example</h1>


		<form method="GET" action="{{ route('serial-search') }}">
			<div class="row">
				<div class="col-md-6">
					<input type="text" name="search" class="form-control" placeholder="Search" value="{{ old('search') }}">
				</div>
				<div class="col-md-6">
					<button class="btn btn-success">Search</button>
				</div>
			</div>
		</form>


		<table class="table table-bordered">
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Nội dung</th>
				<th>Giá</th>
				<th>User ID</th>
				<th>Ngày tạo</th>
				<th>Ngày cập nhật</th>
			</tr>

		</table>
	</div>
    <script>

    </script>
@endsection
