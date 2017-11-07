@extends('shared.singleton')

@section('title', '找回密码')
@section('keywords', '找回密码')
@section('description', '通过注册邮箱找回密码')

@section('content')
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title">找回密码</h5>
                            </div>
                            <div class="panel-body">
                                @include('features.builtIn-alert')

                                <form class="form-horizontal" method="POST" action="{{ route('password.rescue') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="email" class="col-sm-4 control-label">注册邮箱</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="email" id="email" class="form-control" placeholder="请填入您注册时登记的邮箱" />
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