@if (count($errors) > 0)
                        <div class="alert alert-danger" role="alert">
                            <ul class="list-unstyled">
@foreach ($errors->all() as $error)
                                <li>
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">错误：</span>
                                    {{ $error }}
                                </li>
@endforeach
                            </ul>
                        </div><!-- /.alert -->
@endif