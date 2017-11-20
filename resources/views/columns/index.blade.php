@extends('shared.singleton')

@section('content')
            <div class="col-xs-12 col-sm-12">
                <div class="well" id="column-header">
                    <h1>热门栏目</h1>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12">
                <ul class="nav nav-tabs" id="inline-menu">
                    <li role="presentation"><a href="#"><i class="glyphicon glyphicon-certificate" aria-hidden="true"></i>推荐<span class="hidden-xs">栏目</span></a></li>
                    <li role="presentation" class="active"><a href="#"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i>热门<span class="hidden-xs">栏目</span></a></li>
                    <li role="presentation"><a href="#"><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>地区</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12">
                <div class="row">
@forelse ($columns as $column)
                    <div class="col-xs-6 col-lg-4">
                        <div class="thumbnail text-center column-thumbnail">
                            <a href="{{ route('column.show', $column->id) }}" class="a icon">
@if ($column->thumbnails->isEmpty())
                                <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWY1YjZmNmU5MCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZjViNmY2ZTkwIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNCIgeT0iMzYuOCI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" alt="{{ $column->name }}" />
@else
                                <img src="{{ $column->thumbnails->first()->url }}" alt="{{ $column->name }}" />
@endif
                            </a>
                            <a href="{{ route('column.show', $column->id) }}" class="a">
                                <h2 class="heading">{{ $column->name }}</h2>
                                <p class="brief hidden-xs">{{ str_limit($column->description, 32) }}</p>
                            </a>
                            <p class="follow"><a class="btn btn-success btn-sm" role="button"><i class="glyphicon glyphicon-plus"></i>关注</a></p>
                            <hr />
                            <p class="count"><a href="{{ route('column.show', $column->id) }}" class="a">{{ $column->articles()->released()->count() }}篇文章</a><i class="divider">&middot;</i>{{ $column->follows()->count() }}人关注</p>
                        </div>
                    </div>
@empty
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p><strong>提示：</strong>还没有出现任何热门的栏目，<a href="#">去创建一个吧</a></p>
                    </div>
@endforelse
                </div>
            </div>
@stop