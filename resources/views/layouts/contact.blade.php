@extends('shared.origin')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li class="active">联系</li>
                </ol>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-content">
                            <h1>内容合作</h1>
                            <dl class="dl-horizontal">
                                <dt>邮箱</dt>
                                <dd>where@domain.suffix</dd>
                                <dt>投稿须知</dt>
                                <dd>
                                    <ol class="list-unstyled">
                                        <li>1、稿件内容请务必<em>以附件形式</em>发送到指定邮箱</li>
                                        <li>2、您的投稿若被采用，本站会支付稿费；所以请您投稿时，备注您的收款方式</li>
                                        <li>3、稿件内容以原创为优；非原创内容投稿，暂时不会有稿费，而是以<abbr title="在本站可用的礼品卡券，虚拟货币">网站代币</abbr>的方式划拨到您的账户</li>
                                    </ol>
                                </dd>
                            </dl>
                            <h2>反馈建议</h2>
                            <dl class="dl-horizontal">
                                <dt>在线反馈</dt>
                                <dd><a href="#feedback">在线反馈</a></dd>
                                <dt>邮箱</dt>
                                <dd>mail@address.suffix</dd>
                            </dl>
                            <h3>商务合作</h3>
                            <dl class="dl-horizontal">
                                <dt>电话</dt>
                                <dd>123-456-7890</dd>
                                <dd>{{ env('APP_ENV') }}</dd>
                                <dt>邮箱</dt>
                                <dd>fakemailbox@fakedomain.suffix</dd>
                            </dl>
                            <h3>广告合作</h3>
                            <dl class="dl-horizontal">
                                <dt>电话</dt>
                                <dd>123-456-7890</dd>
                                <dd>mobile phone number</dd>
                                <dt>邮箱</dt>
                                <dd>mailbox@mailing.blah</dd>
                            </dl>
                        </div>
                    </div>
                </div>
@stop

{{--
    Static pages, shared sidebar
--}}
@section('sidebar')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">快捷导航</h5>
                    </div>
                    <div class="list-group">
                        <a class="list-group-item" href="{{ route('about') }}">关于</a>
                        <a class="list-group-item active" href="{{ route('contact') }}">联系</a>
                        <a class="list-group-item" href="{{ route('help') }}">帮助</a>
                    </div>
                </div>
@stop