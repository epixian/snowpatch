@extends('layout')

@php
	$module_name = 'organizations';
@endphp

@section('title','Organizations')

@section('content')

	@include('layouts.tools.organizations')

	@include('layouts.panels.organizations')

@endsection
