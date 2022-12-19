@error($name)
    <div class="invalid-feedback">{{ $errors->first($name) }}</div>
@enderror
