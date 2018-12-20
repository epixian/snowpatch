<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organization;

class OrganizationsController extends Controller
{
	public function index() 
	{
		$organizations = Organization::all();
		return view('organizations.index', compact('organizations'));
	}
	
	public function create() 
	{
		return view('organizations.create');
	}	
	
	public function store() 
	{	
		Organization::create(request()->validate([
			'name' => 'required',
			'address_line_1' => 'required',
			'city' => 'required',
			'state' => 'required',
			'postal_code' => 'required',
			'country' => 'required'
		]));

		return redirect('/organizations');
	}

	public function show(Organization $organization)
	{
		return view('organizations.show', compact('organization'));
	}

	public function edit(Organization $organization)
	{
		return view('organizations.edit', compact('organization'));
	}

	public function update(Organization $organization)
	{
		$organization->update(request()->validate([
			'name' => 'required',
			'address_line_1' => 'required',
			'city' => 'required',
			'state' => 'required',
			'postal_code' => 'required',
			'country' => 'required'
		]));
		
		return redirect('/organizations');

	}

	public function destroy(Organization $organization)
	{
		$organization->delete();

		return redirect('/organizations');
	}
 
}
