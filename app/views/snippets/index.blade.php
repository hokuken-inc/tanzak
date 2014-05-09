@extends('master')

@section('head')
    <title>{{{ $page_title or 'tanzak' }}}</title>
@stop

@section('body')
<!-- Body
================================================== -->
<div class="container" role="main">
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
