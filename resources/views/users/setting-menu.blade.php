                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">账户设置</h4>
                    </div>
                    <div class="list-group">
                        <a href="{{ route('users.updateProfile', $user->id) }}" class="list-group-item @if (isset($updateProfile) && $updateProfile) active @endif">基本设置</a>
                        <a href="{{ route('users.updateSocials', $user->id) }}" class="list-group-item @if (isset($updateSocials) && $updateSocials) active @endif">关联设置</a>
                        <a href="{{ route('users.updatePrivacy', $user->id) }}" class="list-group-item @if (isset($updatePrivacy) && $updatePrivacy) active @endif">隐私设置</a>
                        <a href="{{ route('users.updateAssists', $user->id) }}" class="list-group-item @if (isset($updateAssists) && $updateAssists) active @endif">辅助设置</a>
                        <a href="{{ route('users.updateAccount', $user->id) }}" class="list-group-item @if (isset($updateAccount) && $updateAccount) active @endif">账户设置</a>
                    </div>
                </div>
