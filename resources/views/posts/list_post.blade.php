@extends('welcome')
@section('page')
<div class="tab-pane active" id="" role="tabpanel" aria-labelledby="course-tab">
    <button class="btn btn-primary mb-3 text-decoration-none">
        <a href="{{ route('create.post') }}" class="text-decoration-none">Thêm bài viết</a>
    </button>
    <form action="" method="post">
        @include('common.block.flash-message')
        <table class=" table table-hover table-light table-stripped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts ?? [] as $post)
                    <tr>

                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title ?? "" }}</td>
                        <td>{{ $post->content ?? ""}}</td>
                        <td>{{ $post->created_at ?? ""}}</td>
                        <td><a href="{{ route('edit.post',['id'=>$post->id]) }}" class="btn btn-warning">Sửa</a>
                        <td><a href="{{ route('delete.post',['id'=>$post->id]) }}" onclick="return confirm('Bạn có chắc chắn xóa không?');"class="btn btn-danger">Xóa</a>
                        <td><a href="{{ route('show.detail',['id'=>$post->id]) }}" class="btn btn-primary">Chi tiết</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- {{ $posts->appends(request()->all())->links('common.component.paginate') }} --}}

        @csrf
    </form>

</div>
@endsection