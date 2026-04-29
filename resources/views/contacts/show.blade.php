@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1>Contact Details</h1>
      <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <table class="table table-bordered">
      <tr>
        <th style="width: 30%">ID</th>
        <td>{{ $contact->id }}</td>
      </tr>
      <tr>
        <th>Name</th>
        <td>{{ $contact->name }}</td>
      </tr>
      <tr>
        <th>Contact</th>
        <td>{{ $contact->contact }}</td>
      </tr>
      <tr>
        <th>Email</th>
        <td>{{ $contact->email }}</td>
      </tr>
    </table>

    @auth
    <div class="d-flex gap-2">
      <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning">Edit</a>

      <form action="{{ route('contacts.destroy', $contact) }}" method="POST"
        onsubmit="return confirm('Are you sure you want to delete this contact?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
      </form>
    </div>
    @endauth
  </div>
</div>
@endsection