{{ Form::open(array('url' => 'admin/edit', 'class'=>'form')) }}
  <div class="form-group">
    {{ Form::text('title', '', array('placeholder'=>'検索', 'class'=>'form-control', 'tabindex'=>1)) }}
  </div>
{{ Form::close() }}
