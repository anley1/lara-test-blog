<?php

namespace LaraTest;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table name
    // if you make a model called 'Post', then by default the table name
    // will be 'posts'. However, you can change that using the following:
    protected $table = 'posts';
    // Note that the above is therefore not needed but useful to know.

    // Here the primary key defaults to 'id', but you could change that too.
    public $primaryKey = 'id';

    // Timestamps
    // You can change if you want the timestamps too
    public $timestamps = true;

    //Posts for a single user
    public function user(){
        return $this->belongsTo('LaraTest\User');
    }
}
