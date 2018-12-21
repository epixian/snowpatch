<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected static $validate = [
		'fname' => 'required',
		'lname' => 'required',
		'title' => 'nullable',
		'work_phone' => 'nullable',
		'mobile_phone' => 'nullable',
		'email_1' => 'nullable|email',
		'email_2' => 'nullable|email'
	];
    protected $guarded = [];

	public function organization()
	{
		return $this->belongsTo(Organization::class);
	}

	public static function validated()
	{
		return self::$validate;
	}
}
