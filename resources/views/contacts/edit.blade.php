@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ __('Edit contact') }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contacts.update', $contact) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            @include('contacts._partials._fields')

        </form>
    @endsection
