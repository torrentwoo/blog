@extends('shared.prototype')

@section('content')
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="page-header">
                            <h1>关联设置<small class="offset-right">社交帐号</small></h1>
                        </div>
                        @include('features.builtIn-alert')

                        <form class="form-horizontal" method="POST" action="{{ route('users.updateSocials', $user->id) }}" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="weibo" class="col-sm-2 control-label">微博</label>
                                <div class="col-sm-6">
                                    <input type="text" name="weibo" id="weibo" class="form-control" placeholder="您在微博的主页地址" value="{{ $user->socials->weibo or null }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="weixin" class="col-sm-2 control-label">微信</label>
                                <div class="col-sm-6">
@if (empty($user->socials->weixin) !== true)
                                    <p>
                                        <img src="{{ route('files.show', $user->socials->weixin) }}" class="media-object avatar-xl" />
                                    </p>
@endif
                                    <input type="file" name="weixin" id="weixin" />
                                    <p class="help-block">请上传您的微信账号的二维码图片</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="qq" class="col-sm-2 control-label">QQ 号码</label>
                                <div class="col-sm-4">
                                    <input type="text" name="qq" id="qq" class="form-control" placeholder="您的 QQ 号码" value="{{ $user->socials->qq or null }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="douban" class="col-sm-2 control-label">豆瓣</label>
                                <div class="col-sm-6">
                                    <input type="text" name="douban" id="douban" class="form-control" placeholder="您在豆瓣的主页地址" value="{{ $user->socials->douban or null }}" />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">更新关联帐号</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
@stop

@section('sidebar')
                @include('users.setting-menu')
@stop