<tr>
    <td>{{ $order->id }}</td>
    <td>
        {{ $order->user->name }}
    </td>
    <td>

        @if ($order->is_balance_order === \App\Enum\DefaultStatusEnum::ON)
            Пополнение баланса
        @else
            @foreach($order->products as $product)
                {{$product->product->name}}<br>
            @endforeach
        @endif
    </td>
    <td>
        @foreach($order->products as $product)
            {{$product->count}} / {{$product->done_count ?? 0}}<br>
        @endforeach
    </td>
    <td>
        {{ $order->amount }}
    </td>
    <td>
        {{ $order->discount }}
    </td>
    <td>
        {{ $order->paymentSystem->name }}
    </td>
    <td>
        <select class="form-control form-control-sm" wire:model="order.status" wire:loading.attr="disabled">
            <option>{{__('status')}}</option>
            @foreach(\App\Enum\Orders\OrderStatusEnum::cases() as $status)
                <option value="{{$status->value}}">{{$status->label()}}</option>
            @endforeach
        </select>
    </td>
    <td>
        <a href="{{ route('orders.edit', ['order'=>$order->id]) }}" class="me-1">
            <i class="fas fa-pencil"></i>
        </a>
    </td>
</tr>
