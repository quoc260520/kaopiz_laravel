@extends('welcome')
@section('page')

    <h3 class="title text-center p-3">Sửa bài viết</h3>

    <div class="table-content container ">

        <div class="row mb-3 p-5 bg-white  shadow-lg border rounded-3">
            <form method="post" action="{{ route('post.edit') }}">
                @include('common.block.flash-message')

                <input name="id" type="hidden" value="{{ $post->id ?? " " }}">

                @include('common.block.input-text', [
                    'lable' => 'Title',
                    'name' => 'title',
                    'value' => old('title') ?? $post->title,
                    'placeholder' => 'Title...',
                    'labelClass' => 'col-sm-3',
                    'inputClass' => 'col-sm-5',
                ])


                @include('common.block.textarea', [
                    'lable' => 'Content',
                    'name' => 'content',
                    'value' => old('content') ?? $post->content,
                    'placeholder' => 'Nội dung',
                    'labelClass' => 'col-sm-3',
                    'inputClass' => 'col-sm-5',
                ])


                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2 mt-3">
                        <div class="form-check">
                            <button type="submit" class="btn btn-primary" name='action'
                                value='create'>Sửa</button>
                        </div>
                    </div>
                </div>
                @csrf
            </form>

        </div>
    </div>

@endsection