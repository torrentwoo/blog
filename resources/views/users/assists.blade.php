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
                                        <input name="editor" id="editor1" value="CKEditor" type="radio" /><span class="radio-label offset-right">富文本</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input name="editor" id="editor2" value="Markdown" type="radio" /><span class="radio-label offset-right">Markdown</span>
                                    </label>
                                    <p class="help-block">在您撰写文章时使用何种编辑器<a href="javascript:void(0)" class="offset-right" data-toggle="modal" data-target="#markdownModal"><i class="glyphicon glyphicon-question-sign" aria-hidden="true"></i>什么是 Markdown</a></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">文章赞赏</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input name="reward" id="reward1" value="enable" type="radio" /><span class="radio-label offset-right">开启</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input name="reward" id="reward2" value="disable" type="radio" /><span class="radio-label offset-right">关闭</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reward-description" class="col-sm-2 control-label">赞赏描述</label>
                                <div class="col-sm-6">
                                    <textarea name="description" id="reward-description" class="form-control" rows="3" placeholder="对于您文章赞赏的描述"></textarea>
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