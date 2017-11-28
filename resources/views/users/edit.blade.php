@extends('shared.singleton')

@section('content')
            <div class="col-xs-12 col-md-12">
                @include('features.builtIn-alert')

                <form class="form-horizontal" method="POST" action="{{ route('user.update', $user->id) }}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="avatar" class="col-sm-2 control-label">头像</label>
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
                        <label for="password" class="col-sm-2 control-label">登录密码</label>
                        <div class="col-sm-4">
                            <input type="text" name="password" id="password" class="form-control" placeholder="若您无须更改密码，留空即可" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="col-sm-2 control-label">确认密码</label>
                        <div class="col-sm-4">
                            <input type="text" name="password_confirmation" id="password_confirmation" class="form-control" />
                        </div>
                    </div>

                    <hr />

                    <div class="form-group">
                        <label for="gender" class="col-sm-2 control-label">性别</label>
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
                        <div class="col-sm-4">
                            <textarea name="introduction" id="introduction" class="form-control" rows="3">{{ $user->introduction }}</textarea>
                        </div>
                    </div>

                    <hr />

                    <div class="form-group">
                        <label for="weibo" class="col-sm-2 control-label">微博</label>
                        <div class="col-sm-4">
                            <input type="text" name="weibo" id="weibo" class="form-control" value="" disabled="disabled" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nickname" class="col-sm-2 control-label">微信</label>
                        <div class="col-sm-4">
                            上传微信个人二维码名片
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="qq" class="col-sm-2 control-label">QQ</label>
                        <div class="col-sm-4">
                            <input type="text" name="qq" id="qq" class="form-control" value="" disabled="disabled" />
                        </div>
                    </div>

                    <hr />

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">更新账户</button>
                        </div>
                    </div>
                </form>
            </div>
@stop