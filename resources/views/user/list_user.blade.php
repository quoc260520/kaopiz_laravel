@extends('welcome')
@section('page')
    <div class="row mb-3 p-5 bg-white  shadow-lg border rounded-3">
        <form method="post" action="">
            @include('common.block.flash-message')

            @include('common.block.input-text', [
                'name' => 'id',
                'lable' => 'ID',
                'value' => old('id'),
                'placeholder' => 'Id user',
                'labelClass' => 'col-sm-3',
                'inputClass' => 'col-sm-5',
            ])

            @include('common.block.input-text', [
                'name' => 'name',
                'lable' => 'Name',
                'value' => old('name'),
                'placeholder' => 'Name user',
                'labelClass' => 'col-sm-3',
                'inputClass' => 'col-sm-5',
            ])

            @include('common.block.input-text', [
                'name' => 'class',
                'lable' => 'Class',
                'value' => old('class'),
                'placeholder' => 'Class user',
                'labelClass' => 'col-sm-3',
                'inputClass' => 'col-sm-5',
            ])




            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2 mt-3">
                    <div class="form-check">
                        <button type="submit" class="btn btn-primary" name='action' value='search'>Tìm kiếm</button>
                    </div>
                </div>
            </div>
            @csrf
        </form>

    </div>
    <div class="tab-pane active" id="" role="tabpanel" aria-labelledby="course-tab">


        <form action="" method="post">

            <table class=" table table-hover table-light table-stripped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Class</th>
                        <th scope="col">Create_at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users?? [] as $user)
                        <tr>

                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->class }}</td>
                            <td>{{ $user->created_at }}</td>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="float-end mb-5">
                {{ $users->appends(request()->all())->links() }}
            </div>
            

            @csrf
        </form>

    </div>
@endsection
