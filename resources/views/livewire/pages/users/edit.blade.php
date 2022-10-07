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
