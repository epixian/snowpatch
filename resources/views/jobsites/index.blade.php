@extends('layout')

@php
	$module_name = 'jobsites';
@endphp

@section('title','Jobsites')

@section('content')

	@include('layouts.tools.jobsites')

	@include('layouts.panels.jobsites')

@endsection
