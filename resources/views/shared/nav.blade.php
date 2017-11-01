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
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('login') }}">登陆</a></li>
                    <li><a href="#logon">注册</a></li>
                    <li><a href="{{ route('help') }}">帮助</a></li>
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
