    <nav class="navbar navbar-fixed-top navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Project name</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ $homeActive or 'void' }}"><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
@if (Auth::check())
                    <li><a href="#notification"><i class="glyphicon glyphicon-bell"></i><i class="sr-only">消息通知</i></a></li>
                    <li class="dropdown">
                        <a id="navUserDropdownMenu" class="dropdown-toggle" data-toggle="dropdown">
                            {{ Auth::user()->name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navUserDropdownMenu">
                            <li><a href="{{ route('user.show', Auth::user()->id) }}"><i class="glyphicon glyphicon-user" aria-hidden="true"></i>个人资料</a></li>
                            <li><a href="{{ route('user.edit', Auth::user()->id) }}"><i class="glyphicon glyphicon-cog" aria-hidden="true"></i>账户设置</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('user.articles',  Auth::user()->id) }}"><i class="glyphicon glyphicon-file" aria-hidden="true"></i>我的文章</a></li>
                            <li><a href="{{ route('user.favorites', Auth::user()->id) }}"><i class="glyphicon glyphicon-heart" aria-hidden="true"></i>我的收藏</a></li>
                            <li><a href="{{ route('user.comments',  Auth::user()->id) }}"><i class="glyphicon glyphicon-comment" aria-hidden="true"></i>我的评论</a></li>
                            <li class="divider"></li>
                            <li><a href="#balance"><i class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></i>我的余额</a></li>
                            <li><a href="#gifts"><i class="glyphicon glyphicon-gift" aria-hidden="true"></i>我的卡券</a></li>
                            <li><a href="#cart"><i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>我的购物车</a></li>
                            <li class="divider"></li>
                            <li><a id="navLogoutLink" href="{{ route('logout') }}"><i class="glyphicon glyphicon-off" aria-hidden="true"></i>注销登录</a></li>
                        </ul>
                    </li>
@else
                    <li class="{{ $loginActive or 'void' }}"><a href="{{ route('login') }}">登陆</a></li>
                    <li class="{{ $registerActive or 'void' }}"><a href="{{ route('register') }}">注册</a></li>
@endif
                    <li class="{{ $helpActive or 'void' }}"><a href="{{ route('help') }}">帮助</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            <span class="sr-only">搜索</span>
                        </a>
                        <div id="nav-search" class="dropdown-menu">
                            <form class="navbar-form" action="{{ route('search') }}" method="get" role="search">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Search for..." />
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit">
                                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </li>
                </ul>
{{--
                <form class="navbar-form navbar-right" action="{{ route('search') }}" method="get">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Search for..." />
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                        </span>
                    </div>
                </form>
--}}
            </div><!-- /.nav-collapse -->
        </div><!-- /.container -->
    </nav><!-- /.nav-element -->
