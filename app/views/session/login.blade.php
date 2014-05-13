@extends('master')

@section('head')
    <title>Log In</title>
@stop

@section('body')
  
  <div class="container-fluid login-body">
    <div class="row login-wrap">
      <div class="col-sm-2 col-sm-offset-5">
      
        {{ Form::open(array('class'=>'form')) }}
            @if ($error = $errors->first('password'))
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{ $error }}
            </div>
            @endif
            
            <div class="form-group">
              {{ Form::text('email', Input::old('email', ''), array('placeholder'=>'メールアドレス or ID', 'class' => 'form-control')) }}
            </div>
            <div class="form-group">
              {{ Form::password('password', array('placeholder' => 'パスワード', 'class' => 'form-control')) }}
            </div>
            <div class="form-group">
              {{ Form::submit('ログイン', array('class' => 'btn btn-danger')) }}
            </div>
        {{ Form::close() }}

      </div>
    </div>
  </div>

@stop