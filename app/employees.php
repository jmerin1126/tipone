<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employees extends Model
{
	protected $fillable = ['firstname' , 'lastname', 'company', 'email', 'phone'];

	public function companyID ()
	{
	//one to many relationship
	
	return $this->belongsTo(companies::class, 'company');

	}
    //
}
