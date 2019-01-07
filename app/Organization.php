<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Organization extends Model
{
	use Sortable;

	const TYPE_UNKNOWN = 0;
	const TYPE_LEAD = 1;
	const TYPE_CLIENT = 2;
	const TYPE_VENDOR = 3;
	const TYPE_SUBCONTRACTOR = 4;

	const STATUS_UNKNOWN = 0;
	const STATUS_CURRENT = 1;
	const STATUS_ARCHIVED = 2;
	
	/**
	 * Validation schema for class attributes
	 * 
	 * @static array
	 */
	protected static $validate = [
		'name' => 'required',
		'address_line_1' => 'required',
		'address_line_2' => 'nullable',
		'city' => 'required',
		'state' => 'required',
		'postal_code' => 'required',
		'country' => 'required',
		'type' => 'nullable|between:0,4',
		'status' => 'nullable|between:0,2',
		'primary_contact_id' => 'nullable'
	];

	/**
	 * Attributes that are not mass assignable
	 * 
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * Attributes that can be sorted
	 * 
	 * @var array
	 */
	public $sortable = [
		'name',
		'location',
		'type',
		'status'
	];
	
	
	/**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function jobsites() 
	{
		return $this->hasMany(Jobsite::class);
	}
	
	/**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function contacts()
	{
		return $this->hasMany(Contact::class);
	}
	
    /**
     * @return array|null
     */
	public static function validated()
	{
		return self::$validate;
	}
	
	/**
	 * @param \App\Jobsite
	 */
	public function addJobsite($jobsite)
	{
		$this->jobsites()->create(compact('jobsite'));
	}
	
	/**
	 * @param \App\Contact
	 */
	public function addContact($contact)
	{
		$this->contacts()->create(compact('contact'));
	}
	
	/**
	 * @param \App\Contact
	 */
	public function setPrimaryContact($contact)
	{
		$this->primary_contact_id = $contact->id;
	}
}

