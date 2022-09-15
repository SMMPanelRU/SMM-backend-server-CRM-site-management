<tr>
    <td>{{ $exportSystem->id }}</td>
    <td>
        @if ($exportSystem->logo ?? null)
            <img src="{{url('/storage/'.$exportSystem->logo)}}" alt="{{ $exportSystem->name }}">
        @endif

        <label class="custom-file-upload">
            <i class="fas fa-cloud-arrow-up"></i>
            <input type="file" wire:model="logo">
        </label>

        <span wire:loading wire:target="logo"><i class="fas fa-loader fa-spin"></i></span>
    </td>
    <td>
        {{ $exportSystem->name }}
    </td>
    <td>
        {{ $exportSystem->slug }}
    </td>
    <td>
        {{ $exportSystem->hanlder }}
    </td>
    <td>
        <select class="form-control form-control-sm" wire:model="extSystem.status" wire:loading.attr="disabled">
            <option>{{__('status')}}</option>
            @foreach(\App\Enum\DefaultStatusEnum::cases() as $status)
                <option value="{{$status->value}}">{{$status->label()}}</option>
            @endforeach
        </select>
    </td>
    <td>
        <a href="{{ route('export_systems.edit', ['exportSystem'=>$exportSystem->id]) }}" class="me-1">
            <i class="fas fa-pencil"></i>
        </a>
        @if (!$deleteLoading)
            <span class="cursor-pointer" wire:click="delete({{$exportSystem->id}})" wire:loading.remove>
                <i class="fas fa-trash"></i>
            </span>
            <span wire:loading wire:target="delete({{$exportSystem->id}})"><i class="fas fa-loader fa-spin"></i></span>
        @endif
    </td>
</tr>
