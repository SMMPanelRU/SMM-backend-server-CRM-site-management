<tr>
    <td>{{ $ticket->id }}</td>
    <td>{{ $ticket->title }}</td>
    <td>{{ $ticket->created_at }}</td>
    <td>{{ $ticket->updated_at }}</td>
    <td>{{ $ticket->closed_at }}</td>
    <td>{{ $ticket->site->name }}</td>
    <td>
        <select class="form-control form-control-sm" wire:model="ticket.status" wire:loading.attr="disabled">
            <option>{{__('status')}}</option>
            @foreach(\App\Enum\Tickets\TicketStatusEnum::cases() as $status)
                <option value="{{$status->value}}">{{$status->label()}}</option>
            @endforeach
        </select>
    </td>
    <td>
        <a href="{{ route('tickets.edit', ['ticket'=>$ticket->id]) }}" class="me-1">
            <i class="fas fa-pencil"></i>
        </a>
    </td>
</tr>
