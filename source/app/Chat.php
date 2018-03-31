<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
	 /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','message','room','user_id'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
