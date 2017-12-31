@extends('shared.singleton')

@section('content')
            <div id="subscription-aside" class="col-xs-10 col-sm-4">
                <dl id="aside-menu">
                    <dt class="header">我的关注</dt>
                    <dd class="extend">
                        <a href="{{ route('subscriptions.recommend') }}" class="small">
                            <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>加关注
                        </a>
                    </dd>
@forelse ($followings as $following)
@if ($following->followable_type === App\Models\User::class)
                    <dd class="list-group">
                        <a href="{{ route('subscriptions.user', $following->followable->id) }}" class="list-group-item">
                            <img class="img-circle avatar-sm offset-left" src="{{ $following->followable->gravatar(48) }}" />
                            <span>{{ $following->followable->name }}</span>
                        </a>
                    </dd>
@elseif ($following->followable_type === App\Models\Column::class)
                    <dd class="list-group">
                        <a href="{{ route('subscriptions.column', $following->followable->id) }}" class="list-group-item">
@if (!$following->followable->thumbnails->isEmpty())
                            <img class="img-rounded avatar-sm offset-left" src="{{ $following->followable->thumbnails->first()->url }}" />
@endif
                            <span>{{ $following->followable->name }}</span>
                        </a>
                    </dd>
@endif
@empty
                    <dd class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p><strong>提示：</strong>您还没有关注任何人或者栏目，试试上面的“加关注”，有惊喜哟</p>
                    </dd>
@endforelse
                </dl>
            </div>
@yield('rightContent')
@stop

@section('scripts')
@yield('subScripts')
@stop