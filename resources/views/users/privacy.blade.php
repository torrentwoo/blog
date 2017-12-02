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
                                <div class="col-sm-10">
                                    <label class="radio-inline">
                                        <input name="message" id="message1" value="any" type="radio" @if (empty($user->privacy->email)!== true && $user->privacy->email === 'any') checked="checked" @endif /><span class="form-label">接收所有</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input name="message" id="message2" value="only" type="radio" @if (empty($user->privacy->email)!== true && $user->privacy->email === 'only') checked="checked" @endif /><span class="form-label" title="我关注的、关注我的，回复过站内信的">仅限相关</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input name="message" id="message3" value="none" type="radio" @if (empty($user->privacy->email)!== true && $user->privacy->email === 'none') checked="checked" @endif /><span class="form-label">拒绝所有</span>
                                    </label>
                                    <p class="help-block">“仅限相关”是指：仅限于接收和我有关联的人的站内信，诸如：我关注的、关注我的，我回复过站内信的</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">邮件通知</label>
                                <div class="col-sm-10">
                                    <label class="radio-inline">
                                        <input name="email" id="email1" value="any" type="radio" @if (empty($user->privacy->email)!== true && $user->privacy->email === 'any') checked="checked" @endif /><span class="form-label">接收所有</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input name="email" id="email2" value="only" type="radio" @if (empty($user->privacy->email)!== true && $user->privacy->email === 'only') checked="checked" @endif /><span class="form-label">仅限有关</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input name="email" id="email3" value="none" type="radio" @if (empty($user->privacy->email)!== true && $user->privacy->email === 'none') checked="checked" @endif /><span class="form-label">拒绝所有</span>
                                    </label>
                                    <p class="help-block">“仅限有关”是指：仅限于接收和我有关的邮件通知，诸如：文章被评论、被赞赏，投稿邀约，系统通知等</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="blacklist" class="col-sm-2 control-label">黑名单</label>
                                <div class="col-sm-6">
                                    <textarea name="blacklist" id="blacklist" class="form-control" rows="3" placeholder="请填入您想列入黑名单的用户（一行一个）">{{ $blacklists or null }}</textarea>
                                    <p class="help-block">在您“黑名单”中的用户：无法评论您的文章，无法在其他评论中艾特您，无法给您发站内信，同时自动从您的粉丝列表中移除，并无法再关注您</p>
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