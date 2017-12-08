@foreach ($replies as $reply)
                                    <div class="media" id="mark-{{ $reply->id }}">
                                        <div class="media-left">
                                            <a href="{{ route('user.show', $reply->commentator->id) }}">
                                                <img class="media-object img-circle avatar-sm" src="{{ $reply->commentator->gravatar(48) }}" />
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <p class="h4 media-heading">{{ $reply->commentator->name }}<small class="offset-right">{{ $reply->created_at->diffForHumans() }}</small></p>
                                            <p>{{ $reply->content }}</p>
@can ('comment', $article->author)
                                            <ul class="list-inline">
                                                <li>
                                                    <button type="button" class="btn btn-default btn-xs btn-vote" data-handler="{{ route('vote.up', $reply->id) }}" aria-voted="{{ $reply->votes()->withType('up')->count() === 0 ? 'false' : 'true' }}" aria-mine="{{ in_array(Auth::id(), $reply->votes->pluck('user_id')->all()) !== true ? 'false' : 'true' }}">
                                                        <i class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></i><span class="vote-result"><span class="vote-amount">{{ $reply->votes()->withType('up')->count() }}</span>人</span>赞
                                                    </button>
                                                </li>
@can ('comment', $reply->commentator)
                                                <li>
                                                    <button type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-target="#reply-form{{ $reply->id }}" aria-expanded="false" aria-controls="reply-form{{ $reply->id }}">
                                                        <i class="glyphicon glyphicon-retweet" aria-hidden="true"></i>回复
                                                    </button>
                                                </li>
@endcan
                                            </ul>
@can ('comment', $reply->commentator)
                                            <div class="reply-form collapse" id="reply-form{{ $reply->id }}">
                                                <div class="alert alert-danger" role="alert">
                                                    <i class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></i>
                                                    <span class="sr-only">错误：</span>
                                                    <span class="alert-response"></span>
                                                </div>
                                                <form method="POST" action="{{ route('comment.reply', $reply->id) }}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="articleId" value="{{ $article->id }}" />
                                                    <div class="form-group">
                                                        <textarea name="reply" class="form-control" rows="3" placeholder="请在此写下您的回复" aria-required="true"></textarea>
                                                    </div>
                                                    <div class="form-group text-right">
                                                        <button type="button" class="btn btn-default btn-sm offset-left" data-toggle="collapse" data-target="#reply-form{{ $reply->id }}" aria-expanded="false" aria-controls="reply-form{{ $reply->id }}">取消</button>
                                                        <button type="submit" class="btn btn-primary btn-sm" data-target="#reply-form{{ $reply->id }}">回复评论</button>
                                                    </div>
                                                </form>
                                            </div>
@endcan
@endcan
@if ($reply->replies->isEmpty() !== true)
                                            @include('features.nested-comment', ['replies' => $reply->replies, 'article' => $article])
@endif
                                        </div>
                                    </div>
@endforeach