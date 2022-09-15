<tr xmlns:wire="http://www.w3.org/1999/xhtml">
    <td>{{ $site->id }}</td>
    <td>
        @if ($site->logo ?? null)
            <img src="{{url('/storage/'.$site->logo)}}" alt="{{ $site->name }}">
        @endif

        <label class="custom-file-upload">
            <i class="fas fa-cloud-arrow-up"></i>
            <input type="file" wire:model="logo">
        </label>

        <span wire:loading wire:target="logo"><i class="fas fa-loader fa-spin"></i></span>
    </td>
    <td>
        <input type="text" wire:model.lazy="site.name" class="form-control form-control-sm"
               wire:loading.attr="disabled">
    </td>
    <td>
        <input type="text" wire:model.lazy="site.url" class="form-control form-control-sm"
               wire:loading.attr="disabled">
    </td>
    <td>{{ $site->created_at }}</td>
    <td>{{ $site->updated_at }}</td>
    <td>
        <select class="form-control form-control-sm" wire:model="site.status" wire:loading.attr="disabled">
            <option>{{__('status')}}</option>
            @foreach(\App\Enum\DefaultStatusEnum::cases() as $status)
                <option value="{{$status->value}}">{{$status->label()}}</option>
            @endforeach
        </select>
    </td>
    <td>
        @if ($apiKey)
            <span class="cursor-pointer" wire:click="hideApiKey" wire:loading.remove>
                <i class="fas fa-eye-slash"></i>
            </span>
            <span wire:loading wire:target="hideApiKey"><i class="fas fa-loader fa-spin"></i></span>
            {{ $apiKey }}
        @else
            <span class="cursor-pointer" wire:click="showApiKey" wire:loading.remove>
                <i class="fas fa-eye"></i>
            </span>
            <span wire:loading wire:target="showApiKey"><i class="fas fa-loader fa-spin"></i></span>
        @endif
    </td>
    <td>
        @if (!$deleteLoading)
            <span class="cursor-pointer" wire:click="delete({{$site->id}})" wire:loading.remove>
                <i class="fas fa-trash"></i>
            </span>
            <span wire:loading wire:target="delete({{$site->id}})"><i class="fas fa-loader fa-spin"></i></span>
        @endif
    </td>
</tr>
