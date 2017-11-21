@extends('users.archetype')

@section('subContent')
                    <div class="col-xs-12">
                        <ul class="nav nav-tabs" id="inline-menu">
                            <li role="presentation"><a href="#like"><i class="glyphicon glyphicon-heart" aria-hidden="true"></i><span class="hidden-xs">我</span>喜欢<span class="hidden-xs">的</span></a></li>
                            <li role="presentation" class="active"><a href="#favorites"><i class="glyphicon glyphicon-bookmark" aria-hidden="true"></i><span class="hidden-xs">我</span>收藏<span class="hidden-xs">的</span></a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12">
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p><strong>提示：</strong>您还没有收藏过任何内容，不如先去本站的其他栏目逛逛，可能有您感兴趣内容哦</p>
                        </div>
                    </div>
@stop