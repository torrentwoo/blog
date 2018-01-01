@extends('shared.singleton')

@section('content')
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-9">
                        <div class="form-group">
                            <label for="writing-title">文章标题</label>
                            <input type="text" name="title" value="" id="writing-title" class="form-control input-lg" placeholder="文章标题" />
                        </div>
                        <div class="form-group">
                            <label for="writing-content">正文内容<small class="offset-right text-muted">正在使用 {{ $editor or 'CKEditor' }} 作为编辑工具</small></label>
                            <textarea name="content" id="writing-content" class="form-control input-lg" rows="3" placeholder="正文内容"></textarea>
                            <ul class="help-block list-inline" id="writing-upload">
                                <li>上传/插入</li>
                                <li class="icon" id="image-trigger" title="插入图像" data-toggle="modal" data-target="#uploadImageModal"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span><span class="sr-only">插入图像</span></li>
                                <li class="icon" id="video-trigger" title="插入视频"><span class="glyphicon glyphicon-film" aria-hidden="true"></span><span class="sr-only">插入视频</span></li>
                                <li class="icon" id="audio-trigger" title="插入音频"><span class="glyphicon glyphicon-music" aria-hidden="true"></span><span class="sr-only">插入音频</span></li>
                                <li class="icon" id="other-trigger" title="上传或插入其他文件"><span class="glyphicon glyphicon-open" aria-hidden="true"></span><span class="sr-only">上传或插入其他文件</span></li>
                                <li class="hidden" id="upload-hint">上传中<span class="ellipsis"></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3"><!-- aside -->
                        <div class="form-group">
                            <label for="writing-column">栏目</label>
                            <input type="text" name="column" id="writing-column" class="form-control" placeholder="本文投稿的栏目" />
                        </div>
                        <div class="form-group">
                            <label for="writing-tags">标签（不超过三个）</label>
                            <input type="text" name="tags" id="writing-tags" class="form-control" placeholder="本文应用的标签" />
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                        <div class="form-group text-center">
                            <input type="hidden" name="text-editor" value="{{ $editor or 'CKEditor' }}" />
                            <button type="button" id="writing-publish" class="btn btn-primary">保存并发表文章</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="uploadImageModal" tabindex="-1" role="dialog" aria-labelledby="uploadImageModalLabel" aria-handler="{{ route('files.upload', 'image') }}"><!-- image -->
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="uploadImageModalLabel">插入图像</h4>
                        </div>
                        <div class="modal-body">
                            <p id="uploadImageModalPrompt" class="alert alert-danger hidden"></p>
                            <div class="form-group" id="image-source">
                                <label>选择图像</label>
                                <input type="file" name="image" accept="image/gif,image/jpeg,image/png" id="image-upload" />
                                <div class="input-group hidden" id="image-remote">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-link"></span></span>
                                    <input type="text" name="image-url" class="form-control" placeholder="请输入网络图片的链接地址" />
                                </div>
                                <p class="help-block"><b>图像</b>：请选择一个图像，<b>仅允许</b>：GIF, JPEG, PNG 格式；<a class="offset-right" id="image-toggle" href="javascript:void(0);" data-target="#image-source" aria-type="upload">或选择网络图片</a></p>
                            </div>
                            <div class="form-group">
                                <label for="image-alt">替代文本</label>
                                <input type="text" name="alternate" class="form-control" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="button" class="btn btn-primary" id="insert-image" data-target="#uploadImageModal">确认</button>
                        </div>
                    </div>
                </div>
            </div>
@stop

@section('scripts')
    <script type="text/javascript" src="/assets/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/assets/ckeditor/adapters/jquery.js"></script>
    <script type="text/javascript" src="/assets/js/FormData-emulator.js"></script>
    <script type="text/javascript" src="/assets/js/app-ckeditorAssist.js"></script>
{{--
    <script type="text/javascript">
        var editor = CKEDITOR.replace('writing-content', {
            customConfig: 'config-writing.js',
            height: 300
        });
        // Override save function
        CKEDITOR.plugins.registered['save'] = {
            init : function(editor) {
                var command = editor.addCommand('save', {
                    modes: {
                        wysiwyg: 1,
                        source: 1
                    },
                    exec: function (editor) {
                        // do something
                        var data = editor.getData();
                        alert(data);
                    }
                });
                editor.ui.addButton('Save', {label: '保存草稿', command: 'save'});
            }
        }
        $('#upload-image').on('click', function() {
            var element = CKEDITOR.dom.element.createFromHtml('<p><img src="https://start.fedoraproject.org/static/images/fedora-logo.png" width="155" alt="title" /></p>');
            editor.insertElement(element);
        });
    </script>
--}}
@stop