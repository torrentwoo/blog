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
                                            <ul class="list-inline">
                                                <li>
                                                    <form method="POST" action="#"><!-- vote up -->
                                                        {{ csrf_field() }}
                                                        <button type="button" class="btn btn-default btn-xs">
                                                            <i class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></i><!--20人-->赞
                                                        </button>
                                                    </form>
                                                </li>
@can ('comment', $reply->commentator)
                                                <li>
                                                    <button type="button" class="btn btn-default btn-xs btn-reply" data-toggle="#reply-form{{ $reply->id }}">
                                                        <i class="glyphicon glyphicon-retweet" aria-hidden="true"></i>回复
                                                    </button>
                                                </li>
@endcan
                                            </ul>
@can ('comment', $reply->commentator)
                                            <div class="reply-form" id="reply-form{{ $reply->id }}">
                                                @include('features.builtIn-alert')

                                                <form method="POST" action="{{ route('comment.reply', $reply->id) }}">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <textarea name="reply" class="form-control" rows="3" placeholder="请在此写下您的回复"></textarea>
                                                    </div>
                                                    <div class="form-group text-right">
                                                        <button type="button" class="btn btn-default btn-sm offset-left" data-toggle="#reply-form{{ $reply->id }}">取消</button>
                                                        <button type="submit" class="btn btn-primary btn-sm">回复评论</button>
                                                    </div>
                                                </form>
                                            </div>
@endcan
@if ($reply->replies->isEmpty() !== true)
                                            @include('features.nested-comment', ['replies' => $reply->replies])
@endif
                                        </div>
                                    </div>
@endforeach