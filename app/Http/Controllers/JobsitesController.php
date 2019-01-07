<?php

namespace App\Http\Controllers;

use App\Jobsite;
use Illuminate\Http\Request;

class JobsitesController extends Controller
{
    /**
     * Display a listing of Jobsites.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// Todo: make filterable
		try {
			
			$jobsites = Jobsite::sortable('name')->paginate(10);
			return view('jobsites.index', compact('jobsites'));
			
		} catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
			
			dd($e);
			
		}
    }

    /**
     * Show the form for creating a new Jobsite.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		$organization = \App\Organization::find($request->input('organization'));
        return view('jobsites.create', compact('organization'));
    }

    /**
     * Store a newly created Jobsite.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		Jobsite::create(request()->validate(Jobsite::validated()));

		return redirect('/organizations/' . $request->input('organization'));
    }

    /**
     * Display the specified Jobsite.
     *
     * @param  \App\Jobsite  $jobsite
     * @return \Illuminate\Http\Response
     */
    public function show(Jobsite $jobsite)
    {
		return view('jobsites.show', compact('jobsite'));
    }

    /**
     * Show the form for editing the specified Jobsite.
     *
     * @param  \App\Jobsite  $jobsite
     * @return \Illuminate\Http\Response
     */
    public function edit(Jobsite $jobsite)
    {
		return view('jobsites.edit', compact('jobsite'));
    }

    /**
     * Update the specified Jobsite.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jobsite  $jobsite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jobsite $jobsite)
    {
		$jobsite->update(request()->validate(Jobsite::validated()));
		
		return redirect('/organizations/' . $request->input('organization'));
    }

    /**
     * Remove the specified Jobsite.
     *
     * @param  \App\Jobsite  $jobsite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jobsite $jobsite)
    {
		$jobsite->delete();

		return redirect('/jobsites');
    }
}
