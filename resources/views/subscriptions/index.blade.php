@extends('subscriptions.archetype')

@section('rightContent')
            <div class="col-xs-12 col-sm-8">
@if ($followings->first()->followable_type === App\Models\User::class)
                <div class="media header-media">
                    <div class="media-left">
                        <a href="{{ route('user.show', $origin->id) }}">
                            <img class="img-rounded" src="{{ $origin->gravatar(64) }}" />
                        </a>
                    </div>
                    <div class="media-body">
                        <h1 class="media-heading h2">{{ $origin->name }}</h1>
                        <p>发表文章{{ $origin->articles->count() }}篇<i class="divider">&middot;</i>获得{{ $origin->likes->count() }}个喜欢</p>
                    </div>
                    <div class="media-right nowrap-landscape" id="user-buttons">
                        <button type="button" class="btn btn-info btn-xs">
                            <i class="glyphicon glyphicon-send" aria-hidden="true"></i>发站内信
                        </button>
                        <a href="{{ route('user.show', $origin->id) }}" class="btn btn-success btn-xs" role="button">
                            个人主页<span class="glyphicon glyphicon-chevron-right offset-right" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
@elseif ($followings->first()->followable_type === App\Models\Column::class)
                <div class="media header-media">
@if (!$origin->thumbnails->isEmpty())
                    <div class="media-left">
                        <a href="{{ route('column.show', $origin->id) }}">
                            <img class="img-rounded" src="{{ $origin->thumbnails->first()->url }}" />
                        </a>
                    </div>
@endif
                    <div class="media-body">
                        <h1 class="media-heading h2">{{ $origin->name }}</h1>
                        <p>收录文章{{ $origin->articles->count() }}篇<i class="divider">&middot;</i>有{{ $origin->follows->count() }}人关注</p>
                    </div>
                    <div class="media-right nowrap-landscape" id="user-buttons">
                        <button type="button" class="btn btn-info btn-xs">
                            <i class="glyphicon glyphicon-ok-circle" aria-hidden="true"></i>投稿
                        </button>
                        <a href="{{ route('column.show', $origin->id) }}" class="btn btn-success btn-xs" role="button">
                            栏目主页<span class="glyphicon glyphicon-chevron-right offset-right" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
@endif
                <ul class="nav nav-tabs" id="inline-menu">
                    <li role="presentation" class="active">
                        <a href="#latest" id="latest-tab" data-toggle="tab" aria-controls="latest" aria-expanded="true" role="tab">
                            <i class="glyphicon glyphicon-bullhorn" aria-hidden="true"></i>最新<span class="hidden-xs">发表</span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#commented" id="commented-tab" data-toggle="tab" aria-controls="commented" aria-expanded="false" role="tab">
                            <i class="glyphicon glyphicon-comment" aria-hidden="true"></i><span class="hidden-xs">最新</span>评论
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#popular" id="popular-tab" data-toggle="tab" aria-controls="popular" aria-expanded="false" role="tab">
                            <i class="glyphicon glyphicon-fire" aria-hidden="true"></i>热门
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="latest" aria-labelledby="latest-tab">
                        latest
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="commented" aria-labelledby="commented-tab">
                        comments
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="popular" aria-labelledby="popular-tab">
                        popular
                    </div>
                </div>
            </div>
@stop

@section('subScripts')
    <script type="text/javascript">
        console.log('document loaded');
    </script>
@stop