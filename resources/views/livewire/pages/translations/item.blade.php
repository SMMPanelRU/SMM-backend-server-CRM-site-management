<tr>
    <td>
        {{ $translation->id }}
    </td>
    <td>
        <input type="text" wire:model="translation.group" class="form-control form-control-sm">
    </td>
    <td>
        <input type="text" wire:model="translation.key" class="form-control form-control-sm">
    </td>
    <td>
        <input type="text" wire:model="translation.text.en" class="form-control form-control-sm">
    </td>
    <td>
        <input type="text" wire:model="translation.text.ru" class="form-control form-control-sm">
    </td>
    <td>
        <a href="{{ route('translations.edit', ['translation'=>$translation->id]) }}" class="me-1">
            <i class="fas fa-pencil"></i>
        </a>
    </td>
</tr>
