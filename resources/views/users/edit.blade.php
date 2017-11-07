@extends('shared.origin')

@section('content')
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        @include('features.builtIn-alert')

                        <form class="form-horizontal" method="POST" action="{{ route('user.update', $user->id) }}">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">头像</label>
                                <div class="col-sm-6">
                                    <img class="img-rounded" src="{{ $user->gravatar(125) }}" alt="个人头像" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">用户名</label>
                                <div class="col-sm-4">
                                    <input type="text" name="username" id="username" class="form-control" value="{{ $user->name }}" disabled="disabled" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">注册邮箱</label>
                                <div class="col-sm-6">
                                    <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" disabled="disabled" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nickname" class="col-sm-2 control-label">用户昵称</label>
                                <div class="col-sm-4">
                                    <input type="text" name="nickname" id="nickname" class="form-control" value="{{ $user->nickname }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">登录密码</label>
                                <div class="col-sm-6">
                                    <input type="text" name="password" id="password" class="form-control" placeholder="若您无须更改密码，留空即可" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="col-sm-2 control-label">确认密码</label>
                                <div class="col-sm-6">
                                    <input type="text" name="password_confirmation" id="password_confirmation" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">更新账户</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
@stop

@section('sidebar')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">用户导航</h5>
                    </div>
                    <div class="list-group">
                        <a class="list-group-item {{ $profile or 'void' }}" href="{{ route('user.show', $user->id) }}">个人资料</a>
                        <a class="list-group-item {{ $account or 'void' }}" href="{{ route('user.edit', $user->id) }}">账户设置</a>
                        <a class="list-group-item disabled" href="#">我的收藏</a>
                    </div>
                </div>
@stop