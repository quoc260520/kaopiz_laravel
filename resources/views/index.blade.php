@extends('welcome')
@section('page')
<style>
    p {
    width: 500px;
    overflow: hidden;
    white-space: nowrap; 
    text-overflow: ellipsis;
    }
</style>
@foreach ($posts as $post)
<div class=" border m-3 p-5 d-flex justify-content-between">
    <div class="col-3">
        {{ $post->title }}
    </div>
    <div class="col-6">
        <p>{{ $post->content }} </p>
    </div>
    <div class="col-3 text-danger">
        <a href="{{ route('detail',['id'=>$post->id]) }}">>>>></a>
    </div>
</div>
@endforeach
<div class="float-end">{{ $posts->links() }}</div>
@endsection