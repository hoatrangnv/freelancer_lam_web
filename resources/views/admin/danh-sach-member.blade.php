@extends('master')
@section('title')
    Dach Sách Mua Thẻ
@endsection
@section('content')
    <table>
        <tr>
            <th>phone</th>
        </tr>
        @foreach($result as $value)
        <tr>
            <td>{{$value->phone  }}</td>
        </tr>
        @endforeach
    </table>
@endsection