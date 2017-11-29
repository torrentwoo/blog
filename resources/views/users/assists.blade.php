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
                                        <input name="editor" id="editor2" value="Markdown" type="radio" /><span class="radio-label offset-right">Markdown<a href="#" class="offset-right"><i class="glyphicon glyphicon-question-sign" aria-hidden="true"></i>什么是 Markdown</a></span>
                                    </label>
                                    <p class="help-block">在您撰写文章时使用的编辑器</p>
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
                                <hr class="visible-xs-block" />
                                <div class="col-sm-4">
                                    <a class="btn btn-success" href="#" role="button">
                                        <i class="glyphicon glyphicon-download-alt" aria-hidden="true"></i>下载我的所有文章
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
@stop

@section('sidebar')
                @include('users.setting-menu')
@stop