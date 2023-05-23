<div class="mb-3">
    <label for="name" class="form-label">{{ __('Name') }}:</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $contact->name ?? '') }}" required>
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="contact" class="form-label">{{ __('Contact') }}:</label>
    <input type="text" name="contact" id="contact" class="form-control @error('contact') is-invalid @enderror"
        value="{{ old('contact', $contact->contact ?? '') }}" required>
    @error('contact')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">{{ __('Email') }}:</label>
    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email', $contact->email ?? '') }}" required>
    @error('email')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <button type="submit" class="btn btn-primary">
        {{ isset($contact) ? __('Edit') : __('Add') }}
    </button>
    <a href="{{ route('contacts.index') }}" class="btn btn-danger">{{__("Cancel")}}</a>
</div>