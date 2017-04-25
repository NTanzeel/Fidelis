@extends('settings.layout', ['title' => 'Profile Settings'])

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ route('settings.account.edit_profile') }}">
        {{ csrf_field() }}

        <fieldset>
            <legend>Profile Settings</legend>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name"
                           value="{{ Auth::user()->name }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email"
                           value="{{ Auth::user()->email }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-md-4 control-label">Private Account</label>

                <div class="col-md-6">
                    <input id="private" type="checkbox" data-size="small" data-off-color='danger' class="form-control"
                           name="private" value="private"
                           @if(Auth::user()->is_private)
                           checked
                            @endif
                    >
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">New Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control"
                           name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="confirm-password" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control"
                           name="password_confirmation">
                </div>

            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-orange">
                        Save
                    </button>
                </div>
            </div>
        </fieldset>
    </form>

    <form class="form-horizontal" role="form" method="POST" action="{{ route('settings.account.delete') }}">
        {{ csrf_field() }}

        <fieldset>
            <legend>Account Settings</legend>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button class="btn btn-danger" type="submit" value="1" name="closeAccount">
                        Close Account
                    </button>
                </div>
            </div>
        </fieldset>
    </form>
@stop