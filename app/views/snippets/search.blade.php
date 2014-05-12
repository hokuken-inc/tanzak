
{{ Form::open(array('url' => '/', 'class'=>'form')) }}
  <div class="tanzak-search-word form-group">
    {{ Form::text('word', '' , array('placeholder'=>'検索', 'class'=>'form-control', 'tabindex'=>1)) }}
    <i class="tanzak-search-icon glyphicon glyphicon-search"></i>
    <div class="tanzak-search-categories">
      <div class="btn-group" data-toggle="buttons">
      @foreach ($categories as $category)
        <label class="btn btn-default btn-xs">
          <input type="checkbox" name="category_ids[]" value="{{ $category->id }}">{{ $category->name }}
        </label>
      @endforeach
      </div>
    </div>

  </div>
{{ Form::close() }}

<table class="table">
  <thead>
    <tr>
      <th>title</th>
      <th>category id</th>
      <th>category</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($snippets as $snippet)
    <tr>
      <td>{{ $snippet->title }}</td>
      <td>{{ $snippet->category_id }}</td>
      <td>{{ $snippet->category()->first()->name }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
