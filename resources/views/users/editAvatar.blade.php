@extends('layouts.default')

@section('title', '修改头像')

@section('body')
    <div class="row">
        <div class="col-md-3">
            @include('users.partials._settingNav')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        修改头像
                    </h3>
                </div>
                <div class="panel-body">
                    {{--引入错误信息提示--}}
                    @include('layouts.partials._errors')
                    <form action="{{ route('web.users.update_avatar', $user->id) }}" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <p>请选择头像：</p>
                        <img src="{{ avatar_min($user->avatar) }}" class="avatar-preview-img">
                        <div class="form-group">
                            <input type="file" name="avatar">
                        </div>
                        <button type="submit" class="btn btn-primary">上传头像</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection