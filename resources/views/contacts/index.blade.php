@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1>Contacts</h1>
  <a href="{{ route('contacts.create') }}" class="btn btn-primary">Add Contact</a>
</div>

<table class="table table-bordered table-hover">
  <thead class="table-dark">
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Contact</th>
      <th>Email</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($contacts as $contact)
    <tr>
      <td>{{ $contact->id }}</td>
      <td>
        <a href="{{ route('contacts.show', $contact) }}">{{ $contact->name }}</a>
      </td>
      <td>{{ $contact->contact }}</td>
      <td>{{ $contact->email }}</td>
      <td>
        <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-warning">Edit</a>

        <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline"
          onsubmit="return confirm('Are you sure you want to delete this contact?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="5" class="text-center text-muted">No contacts found.</td>
    </tr>
    @endforelse
  </tbody>
</table>

{{ $contacts->links() }}
@endsection