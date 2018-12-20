@extends('layout')

@section('module_name')
organizations
@endsection

@section('content')
        <h1 class="title">Organizations</h1>
	@foreach ($organizations as $organization)
        <div class="columns">
	  <div class="column"><a href="/organizations/{{ $organization->id }}">{{ $organization->name }}</a></div>
          <div class="column">{{ $organization->address_line_1 }}, {{ $organization->city }}, {{ $organization->state }} {{ $organization->postal_code }}</div>
        </div>
	@endforeach
@endsection
