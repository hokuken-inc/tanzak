<?php

class SnippetController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $snippet_id = '';
        if (Request::isMethod('post'))
        {
            $snippet_id = Input::get('snippet_id');

            // editに飛ばす
        }

        return Redirect::to('admin/edit/'.$snippet_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
        if (Request::isMethod('post'))
        {
            $snippet_id = Input::get('snippet_id');
            $snippet = Snippet::where('id', $snippet_id)->first();
            
            if ( ! $snippet)
            {
                $snippet = new Snippet;
            }
            $snippet->body        = Input::get('body');
            $snippet->title       = Input::get('title');
            $snippet->category_id = Input::get('category_id');

            if ($snippet->save())
            {
                $tags = Input::get('tag');
                $tags = explode(',', $tags);
                $tag_ids = array();
                foreach($tags as $tag)
                {
                    $tag = trim($tag);
                    try
                    {
                        $tag_ids[] = Tag::where('name', '=', $tag)->firstOrFail()->id;
                    }
                    catch(Illuminate\Database\Eloquent\ModelNotFoundException $e)
                    {
                        $instance = new Tag();
                        $instance->name = $tag;
                        $snippet->tags()->save($instance);
                    }
                }
                $snippet->tags()->sync(array_merge($snippet->tags->lists('id'), $tag_ids));
            }
            else
            {
                
            }
            
/*             $snippet->priority    = Input::get('priority'); */
            
            
            return Redirect::to('/');
        }

        return Redirect::to('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        
        $is_admin = Auth::check();
        
        $word = '';
        $serach_categories = array();
        $serach_tags = array();
        if (Request::isMethod('post'))
        {
            $word = Input::get('word');
            $serach_categories = Input::get('categories', array());
            $serach_tags = Input::get('tags', array());
            $snippets = Snippet::setTags($serach_tags)->setCategories($serach_categories)->search($word)->get();
        }
        else
        {
            $snippets = Snippet::all();
        }

        $categories = Category::all();
        $tags = Tag::all();

        $this->layout = View::make('snippets.index')->with(array(
            'word' => $word,
            'search_categories' => $serach_categories,
            'search_tags' => $serach_tags,
            'snippets' => $snippets,
            'categories' => $categories,
            'tags' => $tags,
            'view'  => 'snippets.search',
            'is_admin' => $is_admin,
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($snippet_id = '')
    {
        // $id からページのソースをひっぱってきて
        // textarea に入れる
        
        $snippet = Snippet::where('id', $snippet_id)->first();
        $categories = Category::all();
        
        if (! $snippet)
        {
            $snippet = new Snippet;
        }
        
        $this->layout = View::make('snippets.index')->with(array(
           'snippet' => $snippet,
           'categories' => $categories,
           'view'  => 'snippets.edit',
           'is_admin' => true,
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($snippet_id)
    {
        $snippet = Snippet::where('id', $snippet_id)->first();
        $snippet->delete();
        
        return Redirect::to('/');
    }

}
