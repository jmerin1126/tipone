<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class companies extends Model
{
	protected $fillable = ['name' , 'email', 'logo', 'website'];
    //
}
