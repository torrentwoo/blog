@extends('shared.singleton')

@section('content')
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">用户登录</h2>
                    </div>
                    <div class="panel-body">
                        <form action="#" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="username">您的帐号</label>
                                <input type="text" class="form-control" name="username" id="username" />
                            </div>
                            <div class="form-group">
                                <label for="password">登录密码</label>
                                <input type="password" id="password" class="form-control" name="password" />
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