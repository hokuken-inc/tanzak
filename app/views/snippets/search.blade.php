
{{ Form::open(array('url' => '/', 'class'=>'form')) }}
  <div class="tanzak-search-word form-group">
    {{ Form::text('word', e($word), array('placeholder'=>'検索', 'class'=>'form-control', 'tabindex'=>1)) }}
    <button type="submit" class="btn btn-default btn-sm tanzak-search-icon"><i class="glyphicon glyphicon-search"></i></button>
    <div class="tanzak-search-categories">
      <div class="btn-group tanzak-search-btn-group" data-toggle="buttons">
      @foreach ($categories as $category)
        <label class="btn btn-default btn-xs {{ in_array($category->id, $search_categories) ? 'active' : '' }}">
          <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, $search_categories) ? 'checked' : '' }}>{{ $category->name }}
        </label>
      @endforeach
      </div>
    </div>
  </div>
  <div class="form-group tanzak-search-tags">
      <label class="tanzak-search-icon-tags"><i class="glyphicon glyphicon-tags"></i></label>
      <div class="btn-group tanzak-search-btn-group" data-toggle="buttons">
      @foreach ($tags as $tag)
        <label class="btn btn-default btn-xs {{ in_array($tag->id, $search_tags) ? 'active' : '' }}">
          <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, $search_tags) ? 'checked' : '' }}>{{ $tag->name }}
        </label>
      @endforeach
      </div>
  </div>
  
{{ Form::close() }}


<div class="tanzak-list">
  @if($is_admin)
    <a href="{{ url('admin/create') }}" class="tanzak-add pull-right"><i class="glyphicon glyphicon-plus"></i></a>
  @endif
  <table class="table">
    <thead>
      <tr>
        <th>title</th>
        <th>category</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    @foreach ($snippets as $snippet)
      <tr>
        <td>{{ $snippet->title }}</td>
        <td class="text-center"><label class="label label-default">{{ $snippet->category()->first()->name }}</label></td>
        <td class="text-right">
        @if ($is_admin)
          <a href="{{ url('admin/edit/'.$snippet->id) }}" class="text-muted" title="編集"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;&nbsp;
          <a href="{{ url('admin/destroy/'.$snippet->id) }}" class="text-danger" title="削除" onclick="return confirm('Delete ?');"><i class="glyphicon glyphicon-remove"></i></a>
        @endif

        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>

