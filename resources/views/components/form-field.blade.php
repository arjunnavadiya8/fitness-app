<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    @if ($type === 'select')
        <select name="{{ $name }}" id="{{ $name }}" class="form-select">
            @foreach ($options as $key => $option)
                <option value="{{ $key }}" {{ old($name, $value) == $key ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-control" value="{{ old($name, $value) }}">
    @endif

    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
