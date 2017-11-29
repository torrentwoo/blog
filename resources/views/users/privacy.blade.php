@extends('shared.prototype')

@section('content')
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="page-header">
                            <h1>隐私设置<small class="offset-right">隐私、消息</small></h1>
                        </div>
                        @include('features.builtIn-alert')

                        <form class="form-horizontal" method="POST" action="{{ route('user.updatePrivacy', $user->id) }}">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">站内信</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input name="message" id="message1" value="any" type="radio" /><span class="radio-label offset-right">任何人</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input name="message" id="message2" value="only" type="radio" /><span class="radio-label offset-right">我关注的、关注我的，回复过站内信的</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">邮件通知</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input name="notification" id="notification1" value="all" type="radio" /><span class="radio-label offset-right">所有动态</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input name="notification" id="notification2" value="follow" type="radio" /><span class="radio-label offset-right">我关注的</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input name="notification" id="notification3" value="me" type="radio" /><span class="radio-label offset-right">提及我的</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input name="notification" id="notification4" value="none" type="radio" /><span class="radio-label offset-right">不接收任何通知</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="blacklist" class="col-sm-2 control-label">黑名单</label>
                                <div class="col-sm-6">
                                    <textarea name="blacklist" id="blacklist" class="form-control" rows="3" placeholder="被屏蔽的用户，一行一个"></textarea>
                                    <p class="help-block">在“黑名单”中的用户，无法评论您的文章，无法在评论中<mark>艾特您</mark>，无法给您发站内信，也无法关注您</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">更新隐私设置</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
@stop

@section('sidebar')
                @include('users.setting-menu')
@stop