<select @if ($defer ?? true) wire:model.defer="{{ $model }}" @else wire:model="{{ $model }}" @endif id="{{ $model }}"
        class="form-control form-control-sm @if($errors->has($model)) border-danger @endif @if($class ?? null) {{$class}} @endif">

    @if ($placeholder ?? null)
        <option value=""> {{ $placeholder }}</option>
    @else
        <option value="">{{__('fields.choose')}}</option>
    @endif

    @foreach($values as $k=>$v)
        <option value="{{ $k }}">{{ $v }}</option>
    @endforeach
</select>
@error($model) <span
    class="text-danger ">{{ $message }}</span> @enderror
