@extends('shared.prototype')

@section('content')
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="page-header">
                            <h1>关联设置<small class="offset-right">社交帐号绑定</small></h1>
                        </div>
                        @include('features.builtIn-alert')

                        <form class="form-horizontal" method="POST" action="{{ route('user.updateSocials', $user->id) }}" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="weibo" class="col-sm-2 control-label">绑定微博</label>
                                <div class="col-sm-4">
                                    <input type="text" name="weibo" id="weibo" class="form-control" value="" placeholder="其实是您微博的个人页面" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="weixin" class="col-sm-2 control-label">绑定微信</label>
                                <div class="col-sm-6">
                                    <p>
                                        <img src="#" class="media-object avatar-md" />
                                    </p>
                                    <input type="file" name="weixin" id="weixin" />
                                    <p class="help-block">请上传您个人的微信二维码图片</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="qq" class="col-sm-2 control-label">绑定 QQ</label>
                                <div class="col-sm-4">
                                    <input type="text" name="qq" id="qq" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="douban" class="col-sm-2 control-label">绑定豆瓣</label>
                                <div class="col-sm-4">
                                    <input type="text" name="douban" id="douban" class="form-control" value="" />
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