<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organization;
use App\Contact;

class OrganizationContactsController extends Controller
{
    /**
     * @param  \App\Organization
     * @return \Illuminate\Http\Response
     */
    public function store(Organization $organization)
    {
    	$organization->addContact(
    		request()->validate(Contact::validated()),
    		request()->has('setPrimaryContact')
    	);
    	return back();
    }

    /**
     * @param  \App\Organization
     * @return \Illuminate\Http\Response
     */
    public function update(Organization $organization)
    {
    	$organization->updateContact(
            request()->validate(Contact::validated()),
            request()->has('setPrimaryContact')
        );
    	return back();
    }
}
