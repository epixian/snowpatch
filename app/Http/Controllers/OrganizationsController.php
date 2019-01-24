<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organization;

class OrganizationsController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index() 
	{
		// Todo: make filterable
        try {
            
            $organizations = Organization::sortable('name')->paginate(10);
            return view('organizations.index', compact('organizations'));
            
        } catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
            
            dd($e);
            
        }
	}
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function create() 
	{
		return view('organizations.create');
	}	
	
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function store() 
	{	
		Organization::create(request()->validate(Organization::validated()));

		return redirect('/organizations');
	}

    /**
     * Display the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
	public function show(Organization $organization)
	{
		return view('organizations.show', compact('organization'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
	public function edit(Organization $organization)
	{
		return view('organizations.edit', compact('organization'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
	public function update(Organization $organization)
	{
		$organization->update(request()->validate(Organization::validated()));
		
		return redirect('/organizations');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
	public function destroy(Organization $organization)
	{
		$organization->delete();

		return redirect('/organizations');
	}
 
}
