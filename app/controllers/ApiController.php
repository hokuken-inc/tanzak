<?php

class ApiController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    public function search()
    {
        $data = array(
            'error' => '',
            'snippets' => array(),
        );
        
        if (Request::isMethod('post'))
        {
            $word = Input::get('word');
            $serach_categories = Input::get('categories', array());
            $serach_tags = Input::get('tags', array());
            $snippets = Snippet::setTagsByName($serach_tags)->setCategoriesByName($serach_categories)->search($word)->get();

            return Response::json(
                array(
                  'snippets' => $snippets->toArray(),
                ), 200);

        }

        return Response::json(
            array(
              'error'    => '不正なアクセスです',
              'snippets' => array(),
            ), 500);
    }

}
