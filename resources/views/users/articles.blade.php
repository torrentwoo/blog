@extends('users.archetype')

@section('subContent')
                    <div class="col-xs-12">
                        <ul class="nav nav-tabs" id="inline-menu">
                            <li role="presentation" class="active"><a href="{{ route('user.show', $user->id) }}"><i class="glyphicon glyphicon-bullhorn" aria-hidden="true"></i><span class="hidden-xs">个人</span>动态</a></li>
                            <li role="presentation"><a href="#"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i>热门<span class="hidden-xs">内容</span></a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12">
@forelse ($articles as $article)
                        <dl class="well-quirk">
                            <dt><a href="#">{{ $article->title }}</a></dt>
                            <dd>{{ $article->description }}</dd>
                            <dd class="small">Meta summary goes here...</dd>
                        </dl>
@empty
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p><strong>提示：</strong>您还没有发表过任何文章哦</p>
                        </div>
@endforelse
                    </div>
@stop

@section('subScripts')
    <script type="text/javascript">console.log('hello world');</script>
@stop