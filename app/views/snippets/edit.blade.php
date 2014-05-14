{{ Form::open(array('url' => 'admin/edit', 'class'=>'form')) }}

  {{ Form::hidden('snippet_id', e($snippet->id)) }}

  <div class="form-group">
    <div class="btn-group tanzak-edit-btn-group" data-toggle="buttons">
      @foreach ($categories as $category)
        <label class="btn btn-default btn-sm {{ ($category->id === $snippet->category_id) ? ' active' : '' }}">
          <input type="radio" name="category_id" value="{{ $category->id }}" {{ ($category->id === $snippet->category_id) ? ' checked' : '' }}> {{ $category->name }}
        </label>
      @endforeach
      </div>
  </div>


  <div class="form-group">
    <label>タイトル</label>
    {{ Form::text('title', e($snippet->title), array('placeholder'=>'タイトル', 'class'=>'form-control', 'tabindex'=>2)) }}
  </div>
  
  <div class="form-group">
    <label>説明文</label>
    {{ Form::textarea('note', e($snippet->note), array('placeholder'=>'説明文', 'class'=>'form-control', 'tabindex'=>3, 'data-exnote'=>'onready', 'rows'=>2)) }}
  </div>

  <div class="form-group">
    <label>スニペット</label>
    {{ Form::textarea('body', e($snippet->body), array('placeholder'=>'クリックして文章を入力してください。', 'class'=>'form-control', 'tabindex'=>4, 'data-exnote'=>'onready')) }}
  </div>

  <div class="form-group">
    <label>タグ</label>
    {{ Form::text('tag', e(join(',', $snippet->tags()->lists('name'))), array('placeholder'=>'タグ', 'class'=>'form-control', 'tabindex'=>5)) }}
  </div>


  <div class="form-group edit_buttons">
    {{ Form::submit('更新', array('class'=>'btn btn-primary', 'tabindex'=>6)) }}
  </div>

{{ Form::close() }}
