@extends('welcome')
@section('page')
<div class="shadow-sm p-5 mb-5 bg-body rounded">
    <h3 class="title text-center mb-5">{{ $post->title }}</h3>
    <p class="p-5 fs-5 text">
        {{ $post->content }}
    </p>
    <p class="float-end mr-5 fs-5 text">Ngày đăng: {{ $post->created_at }}</p>
</div>
<h4 class="title text-start ml-5 m-3">Commment</h4>
<form action="{{ route('comment',['id'=>$post->id]) }}" method="post">
    <div class="input-group mb-5 col-6">
        <input type="text" class="form-control outline-none" name="comment" aria-label="Example text with button addon" aria-describedby="button-addon1">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon1">Bình luận</button>
    @csrf
    </div>
    @error('comment')
    <p class="text-danger">{{ $message }}</p>
    @enderror
    
</form>

<div class="pb-5 mb-5 mt-5">
    @if($comments->count() == 0)
    <div class="m-3 border p-3">
        <p class="text fs-6">Bài viết chưa có bình luận</p>
    </div>
    @else
    @foreach($comments as $comment)
    <div class="m-3 border p-3">
        <div class="d-flex flex-row">
            <img src="{{ asset('img/avatar.png') }}" alt="Img" class="rounded-circle border" width="30px" height="30px">
            <div class="ml-3">
                <p class="text fs-6">Ẩn danh</p>
                <p class="text fs-6">{{ $comment->created_at }}</p>
            </div>
           
        </div>
        <p class="text fs-6">{{ $comment->content_comment }}</p>
    </div>
    @endforeach
    @endif
</div>
@endsection