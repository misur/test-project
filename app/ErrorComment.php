<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ErrorComment extends Model
{

    protected $fillable = array('text', 'reason','user_id','comment_id');

	protected $table = 'error_comments';
}
