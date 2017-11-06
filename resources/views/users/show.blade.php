@extends('shared.origin')

@section('content')
                <div class="row">
                    <div class="col-xs-6 col-sm-4">
                        <a href="{{ route('user.show', $user->id) }}">
                            <img class="img-rounded img-responsive" src="{{ $user->gravatar(128) }}" alt="{{ $user->name }}" />
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-8">
                        <dl>
                            <dt><h2>{{ $user->name }}</h2></dt>
                            <dd>
                                <em>来自：</em>
                                <i>Planet Earth</i>
                            </dd>
                            <dd>
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                <span>{{ $user->created_at->format('Y-m-d') }} 加入本站</span>
                            </dd>
                        </dl>
                    </div>
                </div>
@stop

@section('sidebar')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">用户导航</h5>
                    </div>
                    <div class="list-group">
                        <a class="list-group-item active" href="{{ route('user.show', $user->id) }}">个人资料</a>
                        <a class="list-group-item disabled" href="#">账户设置</a>
                        <a class="list-group-item disabled" href="#">我的收藏</a>
                    </div>
                </div>
@stop