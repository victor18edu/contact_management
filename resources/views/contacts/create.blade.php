@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ __('Add Contact') }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contacts.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            @include('contacts._partials._fields')

        </form>
    </div>
@endsection
