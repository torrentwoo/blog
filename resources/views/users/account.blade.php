@extends('shared.prototype')

@section('content')
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="page-header">
                            <h1>账户设置<small class="offset-right">帐号密码</small></h1>
                        </div>
                        @include('features.builtIn-alert')

                        <form class="form-horizontal" method="POST" action="{{ route('user.updateAccount', $user->id) }}">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
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

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">
                                    <button type="submit" class="btn btn-primary">更新账户设置</button>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="page-header">
                                    <h2 class="text-danger">删除账户</h2>
                                </div>
                                <p class="help-block">警告：账户一旦被删除，将无法恢复，请务必确认您的操作</p>
                                <a href="#destroy" class="btn btn-danger" role="button">
                                    <i class="glyphicon glyphicon-warning-sign" aria-hidden="true"></i>删除我的账户
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
@stop

@section('sidebar')
                @include('users.setting-menu')
@stop