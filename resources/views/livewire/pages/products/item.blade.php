<tr xmlns:wire="http://www.w3.org/1999/xhtml">
    <td>{{ $product->id }}</td>
    <td>{{ $product->name }}</td>
    <td>{{ $product->slug }}</td>
    <td>
        <input type="text" wire:model.lazy="product.sort" class="form-control form-control-sm"
               wire:loading.attr="disabled">
    </td>

    <td>
        <a href="{{ route('products.edit', ['product'=>$product->id]) }}" class="me-1">
            <i class="fas fa-pencil"></i>
        </a>
        @if (!$deleteLoading)
            <span class="cursor-pointer" wire:click="delete({{$product->id}})" wire:loading.remove>
                <i class="fas fa-trash"></i>
            </span>
            <span wire:loading wire:target="delete({{$product->id}})"><i class="fas fa-loader fa-spin"></i></span>
        @endif
    </td>
</tr>
