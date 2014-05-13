
{{ Form::open(array('url' => '/', 'class'=>'form')) }}
  <div class="tanzak-search-word form-group">
    {{ Form::text('word', e($word), array('placeholder'=>'検索', 'class'=>'form-control', 'tabindex'=>1)) }}
    <i class="tanzak-search-icon glyphicon glyphicon-search"></i>
    <div class="tanzak-search-categories">
      <div class="btn-group tanzak-search-btn-group" data-toggle="buttons">
      @foreach ($categories as $category)
        <label class="btn btn-default btn-xs {{ in_array($category->id, $search_categories) ? 'active' : '' }}">
          <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" {{ in_array($category->id, $search_categories) ? 'checked' : '' }}>{{ $category->name }}
        </label>
      @endforeach
      </div>
    </div>
  </div>
  <div class="form-group tanzak-search-tags">
      <div class="btn-group tanzak-search-btn-group" data-toggle="buttons">
      @foreach ($tags as $tag)
        <label class="btn btn-default btn-xs {{ in_array($tag->id, $search_tags) ? 'active' : '' }}">
          <input type="checkbox" name="tag_ids[]" value="{{ $tag->id }}" {{ in_array($tag->id, $search_tags) ? 'checked' : '' }}>{{ $tag->name }}
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
        <td>{{ $is_admin ? link_to('admin/edit/'.$snippet->id, '編集') : '' }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>

