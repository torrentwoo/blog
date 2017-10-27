            <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
@section('sidebar')

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Columns list</h3>
                    </div>
                    <div class="list-group">
                        <a href="{{ route('column') }}" class="list-group-item">History<span class="badge">11</span></a>
                        <a href="{{ route('column') }}" class="list-group-item">Math</a>
                        <a href="{{ route('column') }}" class="list-group-item active">Beta testing<span class="badge">7</span></a>
                        <a href="{{ route('column') }}" class="list-group-item">Weapon</a>
                        <a href="{{ route('column') }}" class="list-group-item">Ocean</a>
                        <a href="{{ route('column') }}" class="list-group-item">Landscape</a>
                        <a href="{{ route('column') }}" class="list-group-item">Space</a>
                        <a href="{{ route('column') }}" class="list-group-item">Music</a>
                        <a href="{{ route('column') }}" class="list-group-item">Industry</a>
                    </div>
                </div>
@show
            </div><!--/.sidebar-offcanvas-->