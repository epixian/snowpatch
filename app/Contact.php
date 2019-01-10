<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Contact extends Model
{
	use Sortable;

	/**
	 * Validation schema for class attributes
	 * 
	 * @static array
	 */
	protected static $validate = [
		'fname' => 'required',
		'lname' => 'required',
		'title' => 'nullable',
		'work_phone' => 'nullable',
		'mobile_phone' => 'nullable',
		'email_1' => 'nullable|email',
		'email_2' => 'nullable|email'
	];

	/**
	 * Attributes that are not mass assignable
	 * 
	 * @var array
	 */
    protected $guarded = [];

    /**
     * All of the relationships to be touched when changes occur.
     *
     * @var array
     */
    protected $touches = ['organization'];

	/**
	 * Attributes that can be sorted
	 * 
	 * @var array
	 */
	public $sortable = [
		'fname',
		'lname',
		'title',
		'work_phone',
		'mobile_phone',
		'email_1',
		'email_2'
	];

	/**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function organization()
	{
		return $this->belongsTo(Organization::class);
	}

    /**
     * @return boolean returns true if associated organization's primary contact is set to this contact
     */
	public function isPrimaryContact()
	{
		return ($this->organization->primary_contact_id == $this->id);
	}

	public function isNotPrimaryContact()
	{
		return !$this->isPrimaryContact();
	}

    /**
     * @return array|null 
     */
	public static function validated()
	{
		return self::$validate;
	}
}
