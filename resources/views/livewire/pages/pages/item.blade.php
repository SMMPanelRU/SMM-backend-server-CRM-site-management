<tr>
    <td>{{ $page->id }}</td>
    <td>
        @if ($page->logo ?? null)
            <img src="{{url('/storage/'.$page->logo)}}" alt="{{ $page->name }}">
        @endif

        <label class="custom-file-upload">
            <i class="fas fa-cloud-arrow-up"></i>
            <input type="file" wire:model="logo">
        </label>

        <span wire:loading wire:target="logo"><i class="fas fa-loader fa-spin"></i></span>
    </td>
    <td>
        {{ $page->name }}
    </td>
    <td>
        {{ $page->slug }}
    </td>
    <td>
        <select class="form-control form-control-sm" wire:model="page.status" wire:loading.attr="disabled">
            <option>{{__('status')}}</option>
            @foreach(\App\Enum\DefaultStatusEnum::cases() as $status)
                <option value="{{$status->value}}">{{$status->label()}}</option>
            @endforeach
        </select>
    </td>
    <td>
        <a href="{{ route('pages.edit', ['page'=>$page->id]) }}" class="me-1">
            <i class="fas fa-pencil"></i>
        </a>
        @if (!$deleteLoading)
            <span class="cursor-pointer" wire:click="delete({{$page->id}})" wire:loading.remove>
                <i class="fas fa-trash"></i>
            </span>
            <span wire:loading wire:target="delete({{$page->id}})"><i class="fas fa-loader fa-spin"></i></span>
        @endif
    </td>
</tr>
