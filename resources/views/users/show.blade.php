@extends('shared.singleton')

@section('content')
            <div class="col-xs-4 col-sm-3 col-sm-offset-1">
                <a href="{{ route('user.show', $user->id) }}">
                    <img class="img-rounded img-responsive" src="{{ $user->gravatar(128) }}" alt="{{ $user->name }}" />
                </a>
            </div>
            <div class="col-xs-8 col-sm-8">
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
            <div id="moments" class="col-xs-12 col-sm-10 col-sm-offset-1">
                <dl class="well my-moment">
                    <dt>Title.....</dt>
                    <dd class="occurred"><small>2017-11-11 12AM</small></dd>
                    <dd>hello world, hello world....</dd>
                </dl>
                <dl class="well my-moment">
                    <dt>Title.....</dt>
                    <dd class="occurred"><small>2017-11-11 12AM</small></dd>
                    <dd>hello world, hello world....</dd>
                </dl>
                <dl class="well my-moment">
                    <dt>Title.....</dt>
                    <dd class="occurred"><small>2017-11-11 12AM</small></dd>
                    <dd>hello world, hello world....</dd>
                </dl>
            </div>
            <nav class="col-xs-12 col-sm-10 col-sm-offset-1 text-center" aria-label="Page navigation">
                <ul class="pagination">
                    <li class="disabled">
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
@stop