<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css') }}
    {{ HTML::style(asset('assets/stylesheets/tanzak.css')) }}
    <meta name="author" content="">
    @yield('head')
  </head>
  <body data-spy="scroll">
    @yield('body')
  </body>
</html>