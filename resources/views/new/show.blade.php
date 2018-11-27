@extends('master')
@section('title')
    Tin tức
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
           <h1>{{ $result->title }}</h1>
           <p><img src="{{ URL::to($result->image) }}" alt="" /></p>
           <p>{!! $result->content !!}</p>
    </div>
</div>
@endsection
