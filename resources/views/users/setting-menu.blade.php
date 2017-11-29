                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">账户设置</h4>
                    </div>
                    <div class="list-group">
                        <a href="{{ route('user.updateProfile', $user->id) }}" class="list-group-item @if ($updateProfile) active @endif">基本设置</a>
                        <a href="{{ route('user.updateSocials', $user->id) }}" class="list-group-item @if ($updateSocials) active @endif">关联设置</a>
                        <a href="{{ route('user.updatePrivacy', $user->id) }}" class="list-group-item @if ($updatePrivacy) active @endif">隐私设置</a>
                        <a href="{{ route('user.updateAssists', $user->id) }}" class="list-group-item @if ($updateAssists) active @endif">辅助设置</a>
                        <a href="{{ route('user.updateAccount', $user->id) }}" class="list-group-item @if ($updateAccount) active @endif">账户设置</a>
                    </div>
                </div>
