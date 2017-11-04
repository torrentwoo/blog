                        <form id="embeddedCommentForm" method="POST" action="{{ route('comment', $article->id) }}">
@if (count($errors) > 0)
                            <div class="alert alert-danger" role="alert">
                                <ul class="list-unstyled">
@foreach ($errors->all() as $error)
                                    <li>
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>
                                        {{ $error }}
                                    </li>
@endforeach
                                </ul>
                            </div><!-- /.alert -->
@endif
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea name="comment" class="form-control" rows="3" placeholder="既然都来了，不说点啥么"></textarea>
                            </div>
@if (Auth::check())
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-default">发表评论</button>
                            </div>
@else
@if (isset($modalLogin) && $modalLogin)
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#loginModal">登录发表评论</button>
                            </div>
@else
                            <div class="form-group form-inline">
                                <div class="form-group">
                                    <label for="username">帐号</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="您的帐号" />
                                </div>
                                <div class="form-group">
                                    <label for="password">密码</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="登录密码" />
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" />
                                        <span>记住我（下次自动登录）</span>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-default pull-right">登录并发表</button>
                            </div>
@endif
@endif
                        </form>
