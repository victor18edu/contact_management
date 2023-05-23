@extends('layouts.app')
@section('css')
<style>
    .my-custom-pagination {
        background-color: #f2f2f2;
        padding: 10px;
    }

    .my-custom-pagination a {
        color: #333;
        text-decoration: none;
        padding: 5px;
        margin: 5px;
    }

    .my-custom-pagination .active a {
        background-color: #007bff;
        color: #fff;
    }
</style>

@endsection
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <h2>{{ __('Contact list') }}</h1>
        <div class="text-end">
            <a href="{{ route('contacts.create') }}" class="btn btn-success">{{ __('Add Contact') }}</a>
        </div>
        <div class="mb-3">
          <form action="{{ route('contacts.index') }}">
                <label for="recordsPerPage">{{ __('Records per page') }}:</label>
                <select name="recordsPerPage" id="recordsPerPage" onchange="this.form.submit()">
                    <option value="5" {{ $recordsPerPage == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ $recordsPerPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $recordsPerPage == 20 ? 'selected' : '' }}>20</option>
                </select>
          </form>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Contact') }}</th>
                    <th>{{ __('Email') }}</th>
                    @if(Auth::check())
                        <th>{{ __('Actions') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->contact }}</td>
                        <td>{{ $contact->email }}</td>
                        @if(Auth::check())
                            <td>
                                <a href="{{ route('contacts.show', $contact) }}"
                                    class="btn btn-primary btn-sm">{{ __('Details') }}</a>
                                <a href="{{ route('contacts.edit', $contact) }}"
                                    class="btn btn-warning btn-sm">{{ __('Edit') }}</a>
                                <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this contact?')">{{ __('Delete') }}</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">{{ __('No contacts found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
            
            <tfoot>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Contact') }}</th>
                    <th>{{ __('Email') }}</th>
                    @if(Auth::check())
                        <th>{{ __('Actions') }}</th>
                    @endif
                </tr>
            </tfoot>
        </table>
        <div class="pagination justify-content-center">
            {{ $contacts->links() }}
        </div>
        
    </div>
@endsection
