@foreach ($replies as $reply)
                                    <div class="media" id="mark-{{ $reply->id }}">
                                        <div class="media-left">
                                            <a href="{{ route('user.show', $reply->commentator->id) }}">
                                                <img class="media-object img-circle avatar-sm" src="{{ $reply->commentator->gravatar(48) }}" />
                                            </a>
                                        </div>
                                        <div class="media-body" id="mark-{{ $reply->id }}-body">
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
@can ('comment', $commentator)
                                                <li>
                                                    <button type="button" class="btn btn-default btn-xs btn-reply" data-src="{{ $reply->id }}" data-url="{{ route('comment.reply', $reply->id) }}">
                                                        <i class="glyphicon glyphicon-retweet" aria-hidden="true"></i>回复
                                                    </button>
                                                </li>
@endcan
                                            </ul>
@if ($reply->replies->isEmpty() !== true)
                                            @include('features.nested-comment', ['replies' => $reply->replies, 'commentator' => $reply->commentator])
@endif
                                        </div>
                                    </div>
@endforeach