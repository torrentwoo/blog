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
                            <label for="writing-content">正文内容<small class="offset-right text-muted">正在使用 {{ $editor }} 作为编辑工具</small></label>
                            <textarea name="content" id="writing-content" class="form-control input-lg" rows="3" placeholder="正文内容"></textarea>
                            <ul class="help-block list-inline" id="writing-upload">
                                <li>上传/插入</li>
                                <li class="ico" id="upload-image" title="插入图像"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span><span class="sr-only">插入图像</span></li>
                                <li class="ico" id="upload-video" title="插入视频"><span class="glyphicon glyphicon-film" aria-hidden="true"></span><span class="sr-only">插入视频</span></li>
                                <li class="ico" id="upload-audio" title="插入音频"><span class="glyphicon glyphicon-music" aria-hidden="true"></span><span class="sr-only">插入音频</span></li>
                                <li class="ico" id="upload-other" title="上传或插入其他文件"><span class="glyphicon glyphicon-open" aria-hidden="true"></span><span class="sr-only">上传或插入其他文件</span></li>
                                <li class="hidden-x" id="upload-hint">上传中<span class="ellipsis"></span></li>
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
                            <input type="hidden" name="text-editor" value="{{ $editor or 'html' }}" />
                            <button type="button" id="writing-publish" class="btn btn-primary">保存并发表文章</button>
                        </div>
                    </div>
                </div>
            </div>
@stop

@section('scripts')
    <script type="text/javascript" src="/assets/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('writing-content', { customConfig: 'config-writing.js' } );
    </script>
@stop