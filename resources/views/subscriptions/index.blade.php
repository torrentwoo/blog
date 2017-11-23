@extends('subscriptions.archetype')

@section('rightContent')
            <div class="col-xs-12 col-sm-8">
                <div class="media header-media">
                    <div class="media-left">
                        <a href="#">
                            <img class="img-rounded" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWY1YjZmN2M2YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZjViNmY3YzZhIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNCIgeT0iMzYuOCI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" />
                        </a>
                    </div>
                    <div class="media-body">
                        <h1 class="media-heading h2">主标题</h1>
                        <p>收录文章xxxx篇<i class="divider"></i>有xxxx人关注</p>
                    </div>
                    <div class="media-right nowrap-landscape" id="user-buttons">
                        <button type="button" class="btn btn-info btn-xs">投稿</button>
                        <button type="button" class="btn btn-success btn-xs">
                            <i class="glyphicon glyphicon-minus glyphicon-plus" aria-hidden="true"></i>关注
                        </button>
                    </div>
                </div>
                <ul class="nav nav-tabs" id="inline-menu">
                    <li role="presentation" class="active">
                        <a href="#latest" id="latest-tab" data-toggle="tab" aria-controls="latest" aria-expanded="true" role="tab">
                            <i class="glyphicon glyphicon-bullhorn" aria-hidden="true"></i>最新<span class="hidden-xs">发表</span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#commented" id="commented-tab" data-toggle="tab" aria-controls="commented" aria-expanded="false" role="tab">
                            <i class="glyphicon glyphicon-comment" aria-hidden="true"></i><span class="hidden-xs">最新</span>评论
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#popular" id="popular-tab" data-toggle="tab" aria-controls="popular" aria-expanded="false" role="tab">
                            <i class="glyphicon glyphicon-fire" aria-hidden="true"></i>热门
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="latest" aria-labelledby="latest-tab">
                        latest
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="commented" aria-labelledby="commented-tab">
                        comments
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="popular" aria-labelledby="popular-tab">
                        popular
                    </div>
                </div>
            </div>
@stop

@section('subScripts')
    <script type="text/javascript">
        console.log('document loaded');
    </script>
@stop