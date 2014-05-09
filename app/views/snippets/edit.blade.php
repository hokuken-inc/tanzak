{{ Form::open(array('url' => 'admin/edit', 'class'=>'form')) }}

  {{ Form::hidden('snippet_id', e($snippet->id)) }}

  <div class="form-group">
    <div class="btn-group" data-toggle="buttons">
      @foreach ($categories as $category)
        <label class="btn btn-default">
          <input type="radio" name="category_id" value="{{ $category->id }}"> {{ $category->name }}
        </label>
      @endforeach
      </div>
  </div>


  <div class="form-group">
    {{ Form::text('title', e($snippet->title), array('placeholder'=>'タイトル', 'class'=>'form-control', 'tabindex'=>2)) }}
  </div>
  
  <div class="form-group">
    {{ Form::textarea('note', e($snippet->note), array('placeholder'=>'説明文', 'class'=>'', 'tabindex'=>3, 'data-exnote'=>'onready')) }}
  </div>

  <div class="form-group">
    {{ Form::textarea('body', e($snippet->body), array('placeholder'=>'クリックして文章を入力してください。', 'class'=>'', 'tabindex'=>4, 'data-exnote'=>'onready')) }}
  </div>

  <div class="form-group">
    {{ Form::text('tag', e($snippet->tag), array('placeholder'=>'タグ', 'class'=>'form-control', 'tabindex'=>5)) }}
  </div>


  <div class="form-group edit_buttons">
    {{ Form::submit('更新', array('class'=>'btn btn-primary', 'tabindex'=>6)) }}
  </div>

{{ Form::close() }}
