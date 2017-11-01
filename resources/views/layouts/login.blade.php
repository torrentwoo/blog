@extends('shared.singleton')

@section('content')
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">用户登录</h2>
                    </div>
                    <div class="panel-body">
@if (count($errors) > 0)
                        <div class="alert alert-danger" role="alert">
                            <ul class="list-unstyled">
@foreach ($errors->all() as $error)
                                <li>
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Error:</span>
                                    {{ $error }}
                                </li>
@endforeach
                            </ul>
                        </div><!-- /.alert -->
@endif
                        <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="username">您的帐号</label>
                                <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" />
                            </div>
                            <div class="form-group">
                                <label for="password">登录密码</label>
                                <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" />
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="remember" /> 记住我
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">登录</button>
                            <a class="btn btn-link" href="#">忘记密码了？</a>

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

                            <p>没有帐号？<a href="#">现在注册</a></p>
                        </form>
                    </div>
                </div>
            </div>
@stop