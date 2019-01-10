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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function contacts()
	{
		return $this->hasMany(Contact::class);
	}
	
	/**
	 * @param array The validated array of contact info
	 * @param boolean Whether to set this contact as primary
	 */
	public function addContact($attributes, $setPrimaryContact = false)
	{
		// dd($attributes, $setPrimaryContact);
		$contact = $this->contacts()->create($attributes);
		if ($setPrimaryContact || $this->contacts->count() == 1) 
		{
			$this->primary_contact_id = $contact->id;
		}
		$this->save();
	}

	/**
	 * @param array The validated array of contact info
	 * @param boolean Whether to set this contact as primary
	 */
	public function updateContact($attributes, $setPrimaryContact = false)
	{
		// dd($attributes, $setPrimaryContact);
		$contact = $this->contacts()->update($attributes);
		if ($setPrimaryContact || $this->contacts->count() == 1) 
		{
			$this->primary_contact_id = $contact->id;
		}
		$this->save();
	}

	/**
	 * @param \App\Contact The Contact to delete
	 */
	public function deleteContact(Contact $contact)
	{
		// dd($attributes, $setPrimaryContact);
		dd($contact->belongsTo());
		if ($contact->isPrimaryContact()) 
		{
			if ($this->contacts->count() == 1) {
				$this->primary_contact_id = null;
				$this->contacts->find($contact->id)->delete();
			}
			else
			{
				$this->contacts;
			}
		}
		$contact = $this->contacts()->find($contact->id);

		$this->save();
	}

	/**
	 * @param \App\Contact
	 */
	public function setPrimaryContact($contact)
	{
		$this->primary_contact_id = $contact->id;
	}

	/**
	 * @return boolean
	 */
	public function hasPrimaryContact()
	{
		return $this->primary_contact_id != null;
	}

	/**
	 * @return \App\Contact Retrieves primary contact as set by setPrimaryContact.  Assumes hasPrimaryContact = true.
	 */
	public function getPrimaryContact()
	{
		return $this->contacts->find($this->primary_contact_id);
	}
}

