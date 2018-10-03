@extends('master')
@section('title')
   User Account
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
                <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Tài khoản chính</th>
                                <th>Tài khoản phụ</th>
                                <th>Tạm giữ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                               <td>{{ Auth::user()->name }}</td>
                               <td>{{ Auth::user()->phone_number }}</td>
                               <td>{{ Auth::user()->email }}</td>
                               <td>{{ Auth::user()->money_1 }}</td>
                               <td>{{ Auth::user()->money_2 }}</td>
                               <td>{{ Auth::user()->phone_number }}</td>
                            </tr>
                        </tbody>
                    </table>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-12" >
            <h2>Lịch sử giao dịch</h2>
            <table class="table table-striped "style="overflow-y: scroll">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row"></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td scope="row"></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection