<div class="mb-3">
    <label class="label-dark" for="name">
        Role Name
    </label>
    <input autofocus class="form-text-input-dark @error('name') !border-red-600 !border @enderror" id="name"
        name="name" placeholder="Admin" required type="text" value="{{ old('name') }}" />

    @error('name')
        <p class="form-error-text">{{ $message }}</p>
    @enderror
</div>
