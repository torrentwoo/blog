@extends('users.archetype')

@section('subContent')
                    <div class="col-xs-12">
                        <ul class="nav nav-tabs" id="inline-menu">
                            <li role="presentation" class="active"><a href="#activities"><i class="glyphicon glyphicon-bullhorn" aria-hidden="true"></i>动态</a></li>
                            <li role="presentation"><a href="#popular"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i>热门</a></li><!-- 我的热门文章 -->
                            <li role="presentation"><a href="#comments"><i class="glyphicon glyphicon-comment" aria-hidden="true"></i>评论</a></li><!-- 别人评论我的 -->
                        </ul>
                    </div>
                    <div id="user-moments" class="col-xs-12">
                        <dl class="well my-moment">
                            <dt>Title.....</dt>
                            <dd class="occurred"><small>2017-11-11 12AM</small></dd>
                            <dd>hello world, hello world....</dd>
                        </dl>
                        <dl class="well my-moment">
                            <dt>Title.....</dt>
                            <dd class="occurred"><small>2017-11-11 12AM</small></dd>
                            <dd>hello world, hello world....</dd>
                        </dl>
                        <dl class="well my-moment">
                            <dt>Title.....</dt>
                            <dd class="occurred"><small>2017-11-11 12AM</small></dd>
                            <dd>hello world, hello world....</dd>
                        </dl>
                    </div>
@stop