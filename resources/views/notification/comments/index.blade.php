@extends('shared.prototype')

@section('content')
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="page-header">
                            <h1>收到的评论<small class="offset-right">全部</small></h1>
                        </div>
                        <div class="well well-quirk">
                            <ul class="list-inline">
                                <li>某某</li>
                                <li>评论了您的文章/回复了您的评论</li>
                                <li class="small text-muted">日期时间</li>
                            </ul>
                            <p>这里是评论的内容</p>
                            <blockquote class="small text-muted">
                                <p>这里是被评论的主体内容</p>
                            </blockquote>
                        </div>
                        <div class="well well-quirk">
                            <ul class="list-inline">
                                <li>某某</li>
                                <li>评论了您的文章/回复了您的评论</li>
                                <li class="small text-muted">日期时间</li>
                            </ul>
                            <p>这里是评论的内容</p>
                            <blockquote class="small text-muted">
                                <p>这里是被评论的主体内容</p>
                            </blockquote>
                        </div>
                        <nav class="text-center" aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="disabled">
                                    <a href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                    <a href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
@stop

@section('sidebar')
                @include('notification.menu')
@stop