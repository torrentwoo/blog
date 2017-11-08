@extends('shared.singleton')

@section('content')
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title">重置账户密码</h5>
                            </div>
                            <div class="panel-body">
                                @include('features.builtIn-alert')

                                <form class="form-horizontal" method="POST" action="{{ route('password.update') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="token" value="{{ $token }}" />
                                    <div class="form-group">
                                        <label for="email" class="col-sm-4 control-label">注册邮箱</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="email" id="email" class="form-control" placeholder="请填入您注册时登记的邮箱" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-4 control-label">新的密码</label>
                                        <div class="col-sm-6">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="请为您的账户设定新的登陆密码" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation" class="col-sm-4 control-label">确认密码</label>
                                        <div class="col-sm-6">
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="请确认您的新的登陆密码" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6 col-sm-offset-4">
                                            <button type="submit" title="提交密码找回请求" class="btn btn-primary">提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@stop