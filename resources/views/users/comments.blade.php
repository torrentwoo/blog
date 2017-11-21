@extends('users.archetype')

@section('subContent')
                    <div class="col-xs-12">
                        <ul class="nav nav-tabs" id="inline-menu">
                            <li role="presentation" class="active"><a href="#my-comments"><i class="glyphicon glyphicon-flag" aria-hidden="true"></i>我的<span class="hidden-xs">评论</span></a></li>
                            <li role="presentation"><a href="#"><i class="glyphicon glyphicon-comment" aria-hidden="true"></i>评论<span class="hidden-xs">我的</span></a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12">
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p><strong>提示：</strong>您还没有发表过任何评论，不如先去本站的其他栏目逛逛，可能有您感兴趣内容哦</p>
                        </div>
                    </div>
@stop