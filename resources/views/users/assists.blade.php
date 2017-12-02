@extends('shared.prototype')

@section('content')
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="page-header">
                            <h1>辅助设置<small class="offset-right">文章相关</small></h1>
                        </div>
                        @include('features.builtIn-alert')

                        <form class="form-horizontal" method="POST" action="{{ route('user.updateAssists', $user->id) }}">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">偏好设定</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input name="editor" id="editor1" value="CKEditor" type="radio" @if (empty($user->preference->editor) !== true && $user->preference->editor === 'CKEditor') checked="checked" @endif /><span class="form-label" title="使用“所见即所的”的方式撰写文章">常规</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input name="editor" id="editor2" value="Markdown" type="radio" @if (empty($user->preference->editor) !== true && $user->preference->editor === 'Markdown') checked="checked" @endif /><span class="form-label">Markdown</span>
                                    </label>
                                    <p class="help-block">在您撰写文章时使用何种编辑器<a href="javascript:void(0)" class="offset-right" data-toggle="modal" data-target="#markdownModal"><i class="glyphicon glyphicon-question-sign" aria-hidden="true"></i>什么是 Markdown</a></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">文章赞赏</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input name="reward" id="reward1" value="yes" type="radio" @if (empty($user->preference->reward) !== true && $user->preference->reward === 'yes') checked="checked" @endif /><span class="form-label">开启</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input name="reward" id="reward2" value="no" type="radio"  @if (empty($user->preference->reward) !== true && $user->preference->reward === 'no')  checked="checked" @endif /><span class="form-label">关闭</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reward_description" class="col-sm-2 control-label">赞赏描述</label>
                                <div class="col-sm-6">
                                    <textarea name="reward_description" id="reward_description" class="form-control" rows="3" placeholder="您对于文章赞赏的描述">{{ empty($user->preference->reward_description) !== true ? $user->preference->reward_description : null }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">
                                    <button type="submit" class="btn btn-primary">更新辅助设置</button>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="page-header">
                                    <h2 class="text-primary">文章下载</h2>
                                </div>
                                <p class="help-block">提示：此操作将打包您以往的所有文章供您下载至本地</p>
                                <a class="btn btn-success" href="#download" role="button">
                                    <i class="glyphicon glyphicon-download-alt" aria-hidden="true"></i>下载我的文章
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Markdown introduction modal -->
                <div class="modal fade" id="markdownModal" tabindex="-1" role="dialog" aria-labelledby="markdownModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="markdownModalLabel">Markdown 简介</h4>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            </div>
                        </div>
                    </div>
                </div>
@stop

@section('sidebar')
                @include('users.setting-menu')
@stop