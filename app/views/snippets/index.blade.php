@extends('master')

@section('head')
    <title>{{{ $page_title or 'tanzak' }}}</title>
@stop

@section('body')

<!-- Navigation
================================================== -->
<nav class="navbar navbar-default tanzak-navbar" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".tanzak-navigator">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Tanzak</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse tanzak-navigator">
      <ul class="nav navbar-nav navbar-right">
        @if($is_admin)
        <li>{{ link_to('logout', 'Logout') }}</li>
        @else
        <li>{{ link_to('login', 'Login') }}</li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<!-- Body
================================================== -->
<div class="container tanzak-content" role="main">
  @include($view)
</div>

<!-- Footer
================================================== -->
<footer class="footer">
</footer>

<!-- Script
================================================== -->
{{ HTML::script('//code.jquery.com/jquery.js') }}
{{ HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js') }}

@stop
