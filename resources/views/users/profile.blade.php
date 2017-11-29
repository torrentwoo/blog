@extends('shared.prototype')

@section('content')
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="page-header">
                            <h1>基本设置<small class="offset-right">个人资料</small></h1>
                        </div>
                        @include('features.builtIn-alert')

                        <form class="form-horizontal" method="POST" action="{{ route('user.updateProfile', $user->id) }}" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="avatar" class="col-sm-2 control-label">头像</label>
                                <div class="col-sm-6">
                                    <p>
                                        <img class="media-object img-rounded avatar-md" src="{{ $user->gravatar(128) }}" alt="头像" />
                                    </p>
                                    <input type="file" name="avatar" />
                                    <p class="help-block">正方形最佳，256x256 像素</p>
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
                                <label class="col-sm-2 control-label">性别</label>
                                <div class="col-sm-4">
                                    <label class="radio-inline">
                                        <input name="gender" id="gender1" value="male" type="radio" @if ($user->gender === 'male') checked="checked" @endif /><span class="radio-label offset-right">男</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input name="gender" id="gender2" value="female" type="radio" @if ($user->gender === 'female') checked="checked" @endif /><span class="radio-label offset-right">女</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input name="gender" id="gender3" value="secret" type="radio" @if ($user->gender === 'secret') checked="checked" @endif /><span class="radio-label offset-right">保密</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="location" class="col-sm-2 control-label">所在地</label>
                                <div class="col-sm-6">
                                    <input type="text" name="location" id="location" class="form-control" value="{{ $user->location }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nickname" class="col-sm-2 control-label">用户昵称</label>
                                <div class="col-sm-4">
                                    <input type="text" name="nickname" id="nickname" class="form-control" value="{{ $user->nickname }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="introduction" class="col-sm-2 control-label">个人简介</label>
                                <div class="col-sm-6">
                                    <textarea name="introduction" id="introduction" class="form-control" rows="3" placeholder="您的个人简介">{{ $user->introduction }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">更新基本设置</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
@stop

@section('sidebar')
                @include('users.setting-menu')
@stop