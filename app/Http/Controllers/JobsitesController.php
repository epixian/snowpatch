<?php

namespace App\Http\Controllers;

use App\Jobsite;
use Illuminate\Http\Request;

class JobsitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// Todo: make filterable
        $jobsites = Jobsite::all();
		return view('jobsites.index', compact('jobsites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		$organization = \App\Organization::find($request->input('organization'));
        return view('jobsites.create', compact('organization'));
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     *
     * @param  \App\Jobsite  $jobsite
     * @return \Illuminate\Http\Response
     */
    public function show(Jobsite $jobsite)
    {
		return view('jobsites.show', compact('jobsite'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jobsite  $jobsite
     * @return \Illuminate\Http\Response
     */
    public function edit(Jobsite $jobsite)
    {
		return view('jobsites.edit', compact('jobsite'));
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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
