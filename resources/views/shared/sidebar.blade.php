            <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
@section('sidebar')

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">热门栏目</h3>
                    </div>
                    <div class="list-group">
@foreach ($columns as $genre)
@if ($genre->id === $column->id)
                        <a href="{{ route('column', $genre->id) }}" class="list-group-item active">{{ $genre->name }}<span class="badge">{{ $genre->articles->count() }}</span></a>
@else
                        <a href="{{ route('column', $genre->id) }}" class="list-group-item">{{ $genre->name }}<span class="badge">{{ $genre->articles->count() }}</span></a>
@endif
@endforeach
{{--
                        <a href="{{ route('column', 2) }}" class="list-group-item">Math</a>
                        <a href="{{ route('column', 3) }}" class="list-group-item active">Beta testing<span class="badge">7</span></a>
                        <a href="{{ route('column', 4) }}" class="list-group-item">Weapon</a>
                        <a href="{{ route('column', 5) }}" class="list-group-item">Ocean</a>
                        <a href="{{ route('column', 6) }}" class="list-group-item">Landscape</a>
                        <a href="{{ route('column', 7) }}" class="list-group-item">Space</a>
                        <a href="{{ route('column', 8) }}" class="list-group-item">Music</a>
                        <a href="{{ route('column', 9) }}" class="list-group-item">Industry</a>
--}}
                    </div>
                </div>
@show
            </div><!--/.sidebar-offcanvas-->