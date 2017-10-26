@extends('shared.origin')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="/demo">Home</a></li>
                    <li><a href="{{ route('column') }}">Column</a></li>
                    <li class="active">located</li>
                </ol>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-lg-12">
                        <div class="page-header">
                            <h1>Testing data</h1>
                            <p><span>Posted on {{ date('Y-m-d H:i') }}</span><span class="author">@author</span><span>@visited times</span></p>
                        </div>
                        <div class="page-content">
                            <p>Content goes here...</p>
                            <p>the another block</p>
                            <ol>
                                <li>abc</li>
                                <li>abc</li>
                                <li>abc</li>
                                <li>abc</li>
                                <li>abc</li>
                            </ol>
                        </div>
                        <div id="tagcloud">
                            <a href="{{ route('tag', 1) }}" class="label label-default">标签1</a>
                            <a href="#" class="label label-default">标签2</a>
                            <a href="#" class="label label-default">标签3</a>
                            <a href="#" class="label label-default">标签4</a>
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pager">
                                <li class="previous disabled"><a href="#"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Older</a></li>
                                <li class="next"><a href="#">Newer <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></li>
                            </ul>
                        </nav>
                    </div>
                    <form class="col-xs-12 form-horizontal">
                        <div class="form-group">
                            <textarea name="comment" class="form-control" rows="3" placeholder="Leave your comments here"></textarea>
                        </div>
                        <div class="form-group text-right">
@if (Auth::check())
                            <button type="submit" class="btn btn-default">发表评论</button>
@else
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal">登录发表评论</button>
@endif
                        </div>
                    </form>
@unless (Auth::check())
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="exampleModalLabel">用户登录</h4>
                                </div>
                                <form>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">帐号</label>
                                            <input type="text" class="form-control" id="recipient-name" />
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="control-label">密码</label>
                                            <input class="form-control" id="message-text" />
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remenber" />
                                                <span>记住我（下次自动登录）</span>
                                            </label>
                                            <span class="pull-right">没有帐号？前往<a href="#">注册新用户</a></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary">登录</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
@endunless
                </div>
@stop

@section('sidebar')
                @parent
                <p>Appended entries in [sidebar] section</p>
@stop