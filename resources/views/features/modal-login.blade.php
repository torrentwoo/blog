                    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="loginModalLabel">用户登录</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="modal-username" class="control-label">帐号</label>
                                        <input type="text" name="username" id="modal-username" class="form-control" placeholder="您的帐号" />
                                    </div>
                                    <div class="form-group">
                                        <label for="modal-password" class="control-label">密码</label>
                                        <input type="password" name="password" id="modal-password" class="form-control" placeholder="登录密码" />
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" />
                                            <span>记住我（下次自动登录）</span>
                                        </label>
                                        <span class="pull-right">没有帐号？前往<a href="{{ route('register') }}">注册新用户</a></span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                    <button type="button" id="loginModalSubmit" class="btn btn-primary">登录</button>
                                </div>
                            </div>
                        </div>
                    </div>
