@extends('shared.singleton')

@section('content')
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">用户注册</h2>
                    </div>
                    <div class="panel-body">
                        @include('features.builtIn-alert')

                        <form action="{{ route('user.store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="username">用户名</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="设定您的个人帐号" value="{{ old('username') }}" />
                            </div>
                            <div class="form-group">
                                <label for="email">安全邮箱</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="您的安全邮箱地址，用于注册验证和密码找回" value="{{ old('email') }}" />
                            </div>
                            <div class="form-group">
                                <label for="password">密码</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="设定您帐号的密码" value="{{ old('password') }}" />
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">确认密码：</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="确认您设定的密码" value="{{ old('password_confirmation') }}" />
                            </div>
                            <p class="text-warning">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">注册须知：</span>
                                在您提交表单前，请务必仔细阅读本站的<a class="btn btn-link" href="#" data-toggle="modal" data-target="#logonTermsModal">《服务条款》</a>
                            </p>
                            <button type="submit" class="btn btn-primary btn-block">确认并注册</button>

                            <hr />

                            <div>
                                <p class="text-muted">您还可以通过下列方式登录：</p>
                                <ul class="nav nav-pills nav-justified">
                                    <li class="presentation"><a href="#">微博</a></li>
                                    <li class="presentation"><a href="#">微信</a></li>
                                    <li class="presentation"><a href="#">QQ</a></li>
                                </ul>
                            </div>

                            <hr />

                            <p>已有帐号？<a href="{{ route('login') }}">请登录</a></p>
                        </form>
                    </div>
                </div>
            </div>
            <!-- terms modal dialog -->
            @include('features.modal-terms')
@stop