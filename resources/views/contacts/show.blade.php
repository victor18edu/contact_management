@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Contact details') }}</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $contact->name }}</h5>
                <p class="card-text"><strong>{{ __('Contact') }}:</strong> {{ $contact->contact }}</p>
                <p class="card-text"><strong>{{ __('Email') }}:</strong> {{ $contact->email }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('contacts.index') }}" class="btn btn-primary">{{__("Back")}}</a>
            <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning">{{ __('Edit') }}</a>

            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"
                    onclick="return confirm('Tem certeza que deseja excluir este contact?')">{{ __('Delete') }}</button>
            </form>
        </div>
    </div>
@endsection
