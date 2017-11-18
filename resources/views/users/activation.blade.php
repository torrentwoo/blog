@extends('shared.singleton')

@section('content')
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>请验证您的注册邮箱</h2>
                </div>
                <div class="page-content">
                    <p>您好，欢迎您的加入；<b>请验证您的邮箱，以便激活您的账户</b></p>
                    <dl class="dl-horizontal">
                        <dt>您的注册邮箱：</dt>
                        <dd class="text-info">{{ $user->email }}</dd>
                        <dt>账户激活指引：</dt>
                        <dd>登陆您提交的注册邮箱，检查注册验证通知邮件，点击邮件中的“激活我的账户”按钮（或链接），完成注册验证及账户激活</dd>
                    </dl>
                </div>
            </div>
@stop