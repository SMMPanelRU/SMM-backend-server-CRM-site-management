<tr>
    <td>
        {{ $user->id }}
    </td>
    <td>
        @if ($user->belongsToTeam(\App\Models\Team::query()->where('name', 'Administrators')->first()))
            <i class="fa-light fa-user-secret"></i>
        @endif
        {{ $user->name }}
    </td>
    <td>
        {{ $user->email }}
        @if ($user->email_verified_at ?? null)
            <i class="fa-solid fa-envelope-circle-check"></i>
        @endif
    </td>
    <td>
        {{ $user->balance?->balance ?? 0}}
    </td>
    <td>
        {{ $user->site?->name }}
    </td>
    <td>
        <select class="form-control form-control-sm" wire:model="user.status"
                wire:loading.attr="disabled">
            <option>{{__('fields.choose')}}</option>
            @foreach(\App\Enum\DefaultStatusEnum::cases() as $status)
                <option value="{{$status->value}}">{{$status->label()}}</option>
            @endforeach
        </select>
    </td>
    <td>
        <a href="{{ route('users.edit', ['user'=>$user->id]) }}" class="me-1">
            <i class="fas fa-pencil"></i>
        </a>
    </td>
</tr>
