            <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
@section('sidebar')
@if (isset($columns))
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">热门栏目</h3>
                    </div>
                    <div class="list-group">
@foreach ($columns as $genre)
                        <a href="{{ route('column', $genre->id) }}" class="list-group-item{{ isset($column) && $genre->id === $column->id ? ' active' : null }}">{{ $genre->name }}<span class="badge">{{ $genre->articles()->released()->get()->count() }}</span></a>
@endforeach
                    </div>
                </div>
@endif
@show
            </div><!--/.sidebar-offcanvas-->