<tr>
    <td>{{ $faq->id }}</td>
    <td>
        {{ $faq->question }}
    </td>
    <td>
        <select class="form-control form-control-sm" wire:model="faq.status" wire:loading.attr="disabled">
            <option>{{__('status')}}</option>
            @foreach(\App\Enum\DefaultStatusEnum::cases() as $status)
                <option value="{{$status->value}}">{{$status->label()}}</option>
            @endforeach
        </select>
    </td>
    <td>
        <a href="{{ route('faqs.edit', ['faq'=>$faq->id]) }}" class="me-1">
            <i class="fas fa-pencil"></i>
        </a>
        @if (!$deleteLoading)
            <span class="cursor-pointer" wire:click="delete({{$faq->id}})" wire:loading.remove>
                <i class="fas fa-trash"></i>
            </span>
            <span wire:loading wire:target="delete({{$faq->id}})"><i class="fas fa-loader fa-spin"></i></span>
        @endif
    </td>
</tr>
