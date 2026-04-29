@extends('layouts.app')

@section('content')
<div class="text-center py-5">
    <h1 class="mb-3">Welcome to Contact Management</h1>
    <p class="text-muted mb-4">Manage your contacts easily.</p>
    <a href="{{ route('contacts.index') }}" class="btn btn-primary btn-lg">View Contacts</a>
</div>
@endsection