<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = array('text', 'recomments','plus','minus', 'active','user_id', 'text_id');

	protected $table = 'comments';
}
