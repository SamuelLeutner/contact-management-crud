@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <h1 class="mb-4">Add Contact</h1>

    <form action="{{ route('contacts.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input
          type="text"
          id="name"
          name="name"
          class="form-control @error('name') is-invalid @enderror"
          value="{{ old('name') }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="contact" class="form-label">Contact</label>
        <input
          type="text"
          id="contact"
          name="contact"
          class="form-control @error('contact') is-invalid @enderror"
          value="{{ old('contact') }}"
          maxlength="9"
          pattern="\d{9}"
          inputmode="numeric">
        @error('contact')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input
          type="email"
          id="email"
          name="email"
          class="form-control @error('email') is-invalid @enderror"
          value="{{ old('email') }}">
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection