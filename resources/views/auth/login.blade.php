@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <aside class="col-md-4 offset-sm-4">
        <div class="card">
          <article class="card-body">
            <a href="/register" class="float-right btn btn-outline-primary">Sign up</a>
            <h4 class="card-title mb-4 mt-1">Sign in</h4>
            <p>
              <a href="/twitter/auth" class="btn btn-block btn-outline-info"> <i class="fab fa-twitter"></i> Sign in with Twitter</a>
            </p>
            <hr>
            <form method="POST" action="/login">
              {{ csrf_field() }}
              <div class="form-group">
                <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="******" required>
                @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Login  </button>
                  </div>
                </div>
                <div class="col-md-6 text-right">
                  <a class="small" href="/password/reset">Forgot password?</a>
                </div>
              </div>
            </form>
          </article>
        </div>
      </aside>
    </div>
  </div>
@endsection
