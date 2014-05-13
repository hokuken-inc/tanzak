<?php
class Snippet extends Eloquent {

  	/**
  	 * The database table used by the model.
  	 *
  	 * @var string
  	 */
  	protected $table = 'snippets';

  	protected $fillable = array('title', 'note', 'category_id', 'body');


    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function tags()
    {
        return $this->belongsToMany('Tag');
    }

    /**
     * set tags (i.e Snippet::setTags($tags))
     * @param  Builder $query
     * @param  array  $tags
     * @return Builder $query
     */
    public function scopeSetTags($query, $tags)
    {
        if (count($tags) > 0)
        {
            $snippet_ids = DB::table('snippet_tag')->whereIn('tag_id', $tags)->lists('snippet_id');
            $query->whereIn('id', $snippet_ids);
        } 

        return $query;
    }

    /**
     * set tags (i.e Snippet::setTags($tags))
     * @param  Builder $query
     * @param  array  $tags
     * @return Builder $query
     */
    public function scopeSetTagsByName($query, $tags)
    {
        if (count($tags) > 0)
        {
            $ids = Tag::whereIn('name', $tags)->lists('id');
            if (count($ids) === 0)
            {
                $ids = array(0);
            }

            return $this->scopeSetTags($query, $ids);
        }

        return $query;
    }

    /**
     * set categories (i.e Snippet::setCategories($categories))
     * @param  Builder $query
     * @param  array  $categories 
     * @return Builder $query
     */
    public function scopeSetCategories($query, $categories)
    {
        if (count($categories) > 0)
        {
            $query->where(function($subquery) use ($categories)
            {
                foreach($categories as $category_id)
                {
                  $subquery->where('category_id', '=', $category_id, 'or');
                }
            });
        }

        return $query;
    }

    /**
     * set categories (i.e Snippet::setCategories($categories))
     * @param  Builder $query
     * @param  array  $categories 
     * @return Builder $query
     */
    public function scopeSetCategoriesByName($query, $categories)
    {
        if (count($categories) > 0)
        {
            $ids = Category::whereIn('name', $categories)->lists('id');
            if (count($ids) === 0)
            {
                $ids = array(0);
            }
            
            return $this->scopeSetCategories($query, $ids);
        }

        return $query;
    }

    /**
     * search word (i.e Snippet::search)
     * @param  Builder $query
     * @param  string  $word search word
     * @return Builder $query
     */
    public function scopeSearch($query, $word)
    {
        $search_columns = array('note', 'title', 'body');
        
        // search
        $query = $this->scopeLike($query, $search_columns, $word);

        return $query;
    }

    /**
     * partial match retrieval
     * @param  Builder $query
     * @param  mixed  $colums array or string search columns
     * @param  string $search string search words
     * @return Builder $query
     * @throws RuntimeException when unimplement
     */
    public function scopeLike($query, $columns, $search)
    {
        //全角スペースを半角スペースに変換
        $keyword = mb_convert_kana($search, 's');

        //検索文字を半角スペースで区切って配列に代入
        $keywords = preg_split('/[\s]+/', $keyword, -1, PREG_SPLIT_NO_EMPTY);
        
        if ( ! is_array($columns))
        {
            $columns = array($columns);
        }

        //配列の数だけ繰り返し
        foreach($keywords as $value)
        {
            $query->where(function($subquery) use ($columns, $value)
            {
                foreach ($columns as $col)
                {
                   $subquery->where($col, 'like', '%' . $value . '%', 'or');
                }
            });
        }

        return $query;
    }
}
