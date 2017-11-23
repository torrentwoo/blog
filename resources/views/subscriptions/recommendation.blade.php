@extends('subscriptions.archetype')

@section('rightContent')
            <div class="col-xs-12 col-sm-8">
                <ul class="nav nav-tabs" id="inline-menu">
                    <li role="presentation" class="active">
                        <a href="#authors" id="authors-tab" data-toggle="tab" aria-controls="authors" aria-expanded="true" role="tab">
                            <i class="glyphicon glyphicon-bullhorn" aria-hidden="true"></i><span class="hidden-xs">推荐</span>作者
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#columns" id="columns-tab" data-toggle="tab" aria-controls="columns" aria-expanded="false" role="tab">
                            <i class="glyphicon glyphicon-comment" aria-hidden="true"></i><span class="hidden-xs">推荐</span>栏目
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#dynamic" id="dynamic-tab" data-toggle="tab" aria-controls="dynamic" aria-expanded="false" role="tab">
                            <i class="glyphicon glyphicon-fire" aria-hidden="true"></i>发现
                        </a><!-- random, based on following user -->
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="authors" aria-labelledby="authors-tab">
                        authors
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="columns" aria-labelledby="columns-tab">
                        columns
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="dynamic" aria-labelledby="dynamic-tab">
                        dynamic
                    </div>
                </div>
            </div>
@stop

@section('subScripts')
    <script type="text/javascript">
        console.log('document loaded');
    </script>
@stop