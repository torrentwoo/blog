                <div class="panel panel-default">
                    <div class="list-group">
                        <a href="{{ route('message.index') }}" class="list-group-item">站内信</a>
                        <a href="{{ route('notification.comment') }}" class="list-group-item @if (isset($commentActive) && $commentActive) active @endif">评论</a>
                        <a href="{{ route('notification.request') }}" class="list-group-item @if (isset($requestActive) && $requestActive) active @endif">投稿邀约</a>
                        <a href="{{ route('notification.vote') }}" class="list-group-item @if (isset($voteActive) && $voteActive) active @endif">点赞</a>
                        <a href="{{ route('notification.like') }}" class="list-group-item @if (isset($likeActive) && $likeActive) active @endif">喜欢</a>
                        <a href="{{ route('notification.follow') }}" class="list-group-item @if (isset($followActive) && $followActive) active @endif">关注</a>
                        <a href="{{ route('notification.reward') }}" class="list-group-item @if (isset($rewardActive) && $rewardActive) active @endif">文章</a>
                        <a href="{{ route('notification.others') }}" class="list-group-item @if (isset($othersActive) && $othersActive) active @endif">其他</a>
                    </div>
                </div>
