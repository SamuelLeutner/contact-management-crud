@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1>Contacts</h1>
  @auth
  <a href="{{ route('contacts.create') }}" class="btn btn-primary">Add Contact</a>
  @endauth
</div>

<table class="table table-bordered table-hover">
  <thead class="table-dark">
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Contact</th>
      <th>Email</th>
      {{-- O cabeçalho só aparece se estiver logado --}}
      @auth
      <th>Actions</th>
      @endauth
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

      {{-- A célula inteira só aparece se estiver logado --}}
      @auth
      <td>
        <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-warning">Edit</a>
        <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline"
          onsubmit="return confirm('Are you sure you want to delete this contact?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
      </td>
      @endauth
    </tr>
    @empty
    <tr>
      {{-- Colspan dinâmico: 5 se logado (tem Ações), 4 se visitante (não tem Ações) --}}
      <td colspan="{{ auth()->check() ? 5 : 4 }}" class="text-center text-muted">No contacts found.</td>
    </tr>
    @endforelse
  </tbody>
</table>

{{ $contacts->links() }}
@endsection