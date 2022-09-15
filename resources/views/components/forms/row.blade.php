<tr class="">
    <th class="align-middle">
        <label for="{{ $model }}" class="">{{ $description }}</label>

        @if (isset($defer) )
            <span wire:loading.delay wire:target="{{ $model }}"><i class="fa-solid fa-circle-notch fa-spin"></i></span>
        @endif

    </th>
    <td class="" @if ($key ?? null) wire:key="{{ $key }}" @endif >

        @if ($type === 'select')
            <x-forms.select model="{{ $model }}" :values="$values" defer="{{$defer ?? true }}"/>
        @elseif ($type === 'textarea')
            <x-forms.textarea model="{{ $model }}"/>
        @elseif ($type === 'html')
            <x-forms.html model="{{ $model }}"/>
        @elseif ($type === 'file')
            <x-forms.input type="{{ $type }}" model="{{ $model }}" defer="{{$defer ?? true }}"
                           key="{{$key ?? null }}" disabled="{{$disabled ?? null}}"/>
        @else
            <x-forms.input type="{{ $type }}" model="{{ $model }}" defer="{{$defer ?? true }}"
                           key="{{$key ?? null }}" disabled="{{$disabled ?? null}}"/>
        @endif
    </td>
</tr>
