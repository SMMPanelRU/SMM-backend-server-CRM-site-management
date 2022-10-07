<div>
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-hover table-striped">
                <tr>
                    <th class="wd-10p align-middle">
                        ID
                    </th>
                    <td class="align-middle">
                        <input type="text" disabled value="{{$order->id}}" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <th class="wd-10p align-middle">
                        {{ucfirst(__('form.user'))}}
                    </th>
                    <td class="align-middle">
                        <a href="{{route('users.edit', ['user'=>$order->user_id])}}">{{$order->user->name}}</a>
                    </td>
                </tr>
                <tr>
                    <th class="align-middle">
                        {{__('fields.status')}}
                    </th>
                    <td>
                        <select class="form-control form-control-sm" wire:model.defer="order.status"
                                wire:loading.attr="disabled">
                            <option>{{__('fields.choose')}}</option>
                            @foreach(\App\Enum\Orders\OrderStatusEnum::cases() as $status)
                                <option value="{{$status->value}}">{{$status->label()}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                @foreach($order->details as $detail)
                    <tr>
                        <th class="align-middle">{{__('order.'.$detail->key)}}</th>
                        <td>
                            <input type="text" readonly value="{{$detail->value}}" class="form-control form-control-sm">
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                        <button wire:click="submit" class="btn btn-success me-2" type="button"
                                wire:loading.attr="disabled">{{ucfirst(__('forms.save'))}}</button>

                        <span wire:loading wire:target="submit"><i class="fas fa-loader fa-spin"></i></span>
                    </td>
                </tr>
            </table>
        </div>

        <div class="col-sm-6">
            <table class="table table-hover table-striped ">
                <tr>
                    <th colspan="3">
                        {{ucfirst(__('text.products'))}}
                    </th>
                </tr>
                @foreach($order->products as $product)
                    <tr>
                        <th class="wd-10p align-middle">
                            <a href="{{route('products.edit', ['product'=>$product->product_id])}}">{{$product->product->name}}</a>
                        </th>
                        <td class="align-middle">
                            {{$product->count}} / {{$product->done_count ?? 0}}
                        </td>
                        <td>
                            {{$product->product->exportSystemProduct->name}}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>


    </div>

</div>
