@extends('shared.origin')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li><a href="#">用户</a></li>
                    <li class="active">我的文章</li>
                </ol>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <dl class="well my-moment">
                            <dt>Title.....</dt>
                            <dd class="occurred"><small>2017-11-11 12AM</small></dd>
                            <dd>hello world, hello world....1</dd>
                        </dl>
                        <dl class="well my-moment">
                            <dt>Title.....</dt>
                            <dd class="occurred"><small>2017-11-11 12AM</small></dd>
                            <dd>hello world, hello world....</dd>
                        </dl>
                    </div>
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
@stop

@section('sidebar')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">我的综合评价最高的文章</h5>
                    </div>
                    <div class="list-group">
                        <a class="list-group-item" href="#">Test......</a>
                    </div>
                </div>
@stop