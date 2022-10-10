<div>
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-hover table-striped">
                <tr>
                    <th class="wd-10p align-middle">
                        ID
                    </th>
                    <td class="align-middle">
                        <input type="text" disabled value="{{$user->id}}" class="form-control form-control-sm">
                    </td>
                </tr>

                <x-forms.row model="user.name" description="{{__('fields.name')}}" type="input"/>
                <x-forms.row model="user.email" description="{{__('fields.email')}}" type="input"/>
                <x-forms.row model="user.status" description="{{__('fields.status')}}" type="select"
                             :values="\App\Enum\DefaultStatusEnum::asKeyValue()"/>

                <tr>
                    <th class="align-middle">
                        {{__('fields.balance')}}
                    </th>
                    <td class="align-middle">
                        <form wire:submit.prevent="updateBalance" wire:key="update_balance">
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="text" readonly class="form-control form-control-sm" value="{{$user->balance?->balance ?? 0}}">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" wire:model.defer="balanceChangeValue"
                                           class="form-control form-control-sm @if($errors->has('balanceChangeValue')) border-danger @endif" placeholder="+ -">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" wire:model.defer="balanceChangeDescription"
                                           placeholder="{{__('fields.description')}}"
                                           class="form-control form-control-sm @if($errors->has('balanceChangeDescription')) border-danger @endif">
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-warning">ok</button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
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
                <x-forms.attributes-edit :allAttributes="$allAttributes"/>
            </table>
        </div>


    </div>

</div>
