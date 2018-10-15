@extends('master')
@section('title')
    Dach Sách Rút Tiền
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            <table class="table table-bordered table-sm">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Số tiền</th>
                    <th>Ngân hàng</th>
                    <th>Chi nhánh</th>
                    <th>Số TK</th>
                    <th>Trạng Thái</th>
                    <th>Hành động</th>
                </tr>
                @foreach ($result as $value)
                    <form action="{{ route('admin.withDraw') }}" method="POST">
                        @csrf
                        <input type="hidden" name="widthraw_id" id="widthraw_id" value="{{ $value->widthraw_id }}">
                        <input type="hidden" name="user_id" id="user_id" value="{{ $value->user_id }}">
                        <input type="hidden" name="amount" id="amount" value="{{ $value->amount }}">
                        <tr>
                            <td>{{ $value->widthraw_id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->amount }}</td>
                            <td>{{ $value->bank_name }}</td>
                            <td>{{ $value->bank_branch }}</td>
                            <td>{{ $value->bank_account_number }}</td>
                            <td>
                                @if($value->withdraw_status == 2)
                                    <span class="text-success">Chấp Nhận</span>
                                @elseif($value->withdraw_status == 3) 
                                    <span class="text-danger">Hủy</span>
                                @else 
                                    <span class="text-info">Chờ</span>
                                @endif
                            </td>
                            <td>   
                                <select   name="status" id="status" onchange="this.form.submit();" >
                                    <option value="">Hành Động</option>
                                    <option value="2">Chấp Nhận</option>
                                    <option value="3">Hủy</option>
                                </select>
                            </td>
                        </tr>
                    </form>
                @endforeach
            </table>
        </div>
        <div style="float: right;margin-top:5%"class="text-center">{{ $result->links() }}</div>

    </div>
    <script>
        // submit form
        function Callsubmit(){
            this.form.submit();
            $("#status").prop('disabled', true);
        }
    </script>
@endsection