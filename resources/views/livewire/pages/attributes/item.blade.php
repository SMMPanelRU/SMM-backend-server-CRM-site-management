<tr xmlns:wire="http://www.w3.org/1999/xhtml">
    <td>{{ $attribute->id }}</td>
    <td>{{ $attribute->name }}</td>
    <td>{{ $attribute->type->name }}</td>
    <td>{{ $attribute->slug }}</td>
    <td>{{ __('entities.'.$attribute->entity_type) }}</td>
    <td>{{ $attribute->created_at }}</td>
    <td>{{ $attribute->updated_at }}</td>
    <td>
        <a href="{{ route('attributes.edit', ['attribute'=>$attribute->id]) }}" class="me-1">
            <i class="fas fa-pencil"></i>
        </a>
        @if (!$deleteLoading)
            <span class="cursor-pointer" wire:click="delete({{$attribute->id}})" wire:loading.remove>
                <i class="fas fa-trash"></i>
            </span>
            <span wire:loading wire:target="delete({{$attribute->id}})"><i class="fas fa-loader fa-spin"></i></span>
        @endif
    </td>
</tr>
