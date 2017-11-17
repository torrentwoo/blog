@extends('shared.origin')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li class="active">{{ $column->name }}</li>
                </ol>
                <p>栏目简介……</p>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <ul id="myTabs" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Home</a></li>
                            <li role="presentation"><a aria-expanded="false" href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Profile</a></li>
                            <li role="presentation"><a aria-expanded="false" href="#third" role="tab" id="third-tab" data-toggle="tab" aria-controls="third">Profile</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                                <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="third" aria-labelledby="dropdown1-tab">
                                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                            </div>
                        </div>
                    </div>
@foreach ($articles as $article)
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <a href="{{ route('article', $article->id) }}" title="{{ $article->title }}">
                                <img class="img-responsive" src="{{ $article->snapshot->thumbnail_url or $article->attachment->url }}" alt="{{ $article->title }}" />
                            </a>
                            <div class="caption">
                                <h2>{{ $article->title }}</h2>
                                <p>{{ $article->description }}</p>
                                <p class="text-right"><a class="btn btn-default" href="{{ route('article', $article->id) }}" role="button">View details &raquo;</a></p>
                            </div>
                        </div>
                    </div>
@endforeach
                </div>
                <nav class="text-center" aria-label="Page navigation">
                    {!! $articles->render() !!}
                </nav>
@stop