                        <form id="embeddedCommentForm" method="POST" action="{{ route('article.comment', $article->id) }}">
                            @include('features.builtIn-alert')

                            {{ csrf_field() }}
@if (Auth::check())
                            <div class="form-group">
                                <textarea name="comment" class="form-control" rows="3" placeholder="请在此发表您的评论"></textarea>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-default">发表评论</button>
                            </div>
@else
                            <div class="well text-center">
                                <a href="{{ route('login') }}" class="btn btn-primary" role="button">登录</a>
                                <span class="offset-right">后发表评论</span>
                            </div>
@endif
                        </form>
