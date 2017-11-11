@extends('shared.singleton')

@section('content')
            <div class="col-xs-6 col-sm-3 col-sm-offset-1">
                <a href="{{ route('user.show', $user->id) }}">
                    <img class="img-rounded img-responsive" src="{{ $user->gravatar(128) }}" alt="{{ $user->name }}" />
                </a>
            </div>
            <div class="col-xs-12 col-sm-8">
                <h1>{{ $user->name }}</h1>
                <dl>
                    <dd>
                        <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                        <span class="sr-only">来自：</span>
                        <span>Planet Earth</span>
                    </dd>
                    <dd>
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                        <span>{{ $user->created_at->format('Y-m-d') }} 入驻</span>
                    </dd>
                    <dd>
                        <span class="glyphicon glyphicon-link" aria-hidden="true"></span>
                        <span class="sr-only">个人链接：</span>
                        <span>
                            <i>微博</i>
                            <i>微信</i>
                            <i>...</i>
                        </span>
                    </dd>
                </dl>
            </div>
            <!-- 用户动态展示 -->
            <div class="col-xs-10 col-sm-10 col-sm-offset-1">
                <div class="row">
                    <div class="col-xs-2 col-sm-2">
                        <p>Icon</p>
                    </div>
                    <div class="col-xs-10 col-sm-10">
                        <p>Moment content</p>
                    </div>
                </div>
            </div>
@stop