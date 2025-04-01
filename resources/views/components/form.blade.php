<form action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}">
    @csrf
    @if ($method !== 'GET' && $method !== 'POST')
        @method($method)
    @endif

    <!-- Slot for Form Fields -->
    <div class="form-content">
        {{ $slot }}
    </div>

    <!-- Submit Button -->
    <div class="d-grid mt-3">
        <button type="submit" class="btn btn-primary">{{ $submitText }}</button>
    </div>
</form>
