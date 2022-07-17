@extends('blade_view.layout')
@section('content')
<div class="container" style="margin-top:30px">
    <div class="row">
      @include('blade_view.content.content_left_body')
      @include('blade_view.content.content_right_body')
    </div>
  </div>
@endsection