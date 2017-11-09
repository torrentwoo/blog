@extends('shared.singleton')

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