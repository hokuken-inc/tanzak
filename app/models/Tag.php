<?php
class Tag extends Eloquent {

    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'tags';
    
    public function snippets()
    {
        return $this->belongsToMany('Snippet');
    }

}
