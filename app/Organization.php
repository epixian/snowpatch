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
	 * @param \App\Jobsite The Jobsite to add
	 */
	public function addJobsite(Jobsite $jobsite)
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
			$this->setPrimaryContact($contact);
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
			$this->setPrimaryContact($contact);
		}
		$this->save();
	}

	/**
	 * @param \App\Contact The Contact to delete
	 */
	public function deleteContact(Contact $contact)
	{
		// Contact belongs to this organization
		if($contact->organization->is($this)) 
		{
			// if deleting primary contact
			if($contact->isPrimaryContact())
			{
				// if the only contact in the organization, clear primary_contact_id
				if ($this->contacts->count() == 1)
				{
					$this->primary_contact_id = null;
				}
				// otherwise assign new primary contact
				else
				{
					$this->setPrimaryContact($this->contacts->where('id', '!=', $contact->id)->first());
				}
			}

			// delete the contact and reload relationships
			$this->contacts->find($contact->id)->delete();
			$this->refresh();
		}
		// Contact does not belong to the Organization
		else
		{
			dd('Error: Contact ' . $contact->fname . ' ' . $contact->lname . ' #' . $contact->id . ' does not belong to Organization ' . $this->name . ' #' . $this->id);
		}

	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function primaryContact()
	{
		return $this->hasOne(Contact::class, 'id', 'primary_contact_id');
	}

	/**
	 * @param \App\Contact
	 * @return \App\Contact The new primary contact
	 */
	public function setPrimaryContact($contact)
	{
		// dd($contact->organization == $this);
		// make sure $contact belongs to this Organization
		if($this->contacts->find($contact->id))
		{
			$this->primary_contact_id = $contact->id;
			$this->save();
			$this->refresh();
		}
		else
		{
			dd('Error: Contact ' . $contact->fname . ' ' . $contact->lname . ' #' . $contact->id . ' does not belong to Organization ' . $this->name . ' #' . $this->id);
		}
		return $this->primaryContact;
	}

	/**
	 * @return boolean
	 */
	public function hasPrimaryContact()
	{
		return $this->primaryContact != null;
	}

}

