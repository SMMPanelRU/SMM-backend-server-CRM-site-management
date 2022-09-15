<label class="custom-file-upload">
    <i class="fas fa-cloud-arrow-up"></i>

    <input
        @if ($defer ?? true)
            wire:model.defer="{{ $model }}"
        @else
            wire:model.lazy="{{ $model }}"
        wire:dirty.class="border-danger"
        @endif
        type="{{ $type }}" id="{{ $model }}"
        class="form-control form-control-sm @if($errors->has($model)) border-danger @endif"
        @if ($placeholder ?? null) placeholder="{{ $placeholder }}" @endif
        @if ($disabled ?? null) disabled @endif>

    @error($model) <span class="text-danger">{{ $message }}</span> @enderror
</label>
