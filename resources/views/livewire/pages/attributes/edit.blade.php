<div>
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-hover table-striped">
                @if ($attribute ?? null)
                    <tr>
                        <th class="wd-10p align-middle">
                            ID
                        </th>
                        <td class="align-middle">
                            <input type="text" disabled value="{{$attribute->id}}" class="form-control form-control-sm">
                        </td>
                    </tr>
                @endif

                <x-forms.row model="attribute.name.en" description="{{__('fields.name')}} en" type="input"/>
                <x-forms.row model="attribute.name.ru" description="{{__('fields.name')}} ru" type="input"/>

                <tr>
                    <th class="align-middle">
                        {{__('fields.type')}}
                    </th>
                    <td>
                        <select class="form-control form-control-sm" wire:model.defer="attribute.type"
                                wire:loading.attr="disabled">
                            <option>{{__('fields.choose')}}</option>
                            @foreach(\App\Enum\Attributes\AttributeTypesEnum::cases() as $status)
                                <option value="{{$status->value}}">{{$status->label()}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>


                <x-forms.row model="attribute.slug" description="{{__('fields.slug')}}" type="input"/>

                <tr>
                    <th class="align-middle">
                        {{__('fields.entity_type')}}
                    </th>
                    <td>
                        <select class="form-control form-control-sm" wire:model.defer="attribute.entity_type"
                                wire:loading.attr="disabled">
                            <option>{{__('fields.choose')}}</option>
                            @foreach($attributeEntityTypes as $key=>$value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <th class="align-middle">
                        {{__('fields.is_searchable')}}
                    </th>
                    <td>
                        <select class="form-control form-control-sm" wire:model.defer="attribute.is_searchable"
                                wire:loading.attr="disabled">
                            <option>{{__('fields.choose')}}</option>
                            @foreach(\App\Enum\DefaultStatusEnum::cases() as $status)
                                <option value="{{$status->value}}">{{$status->label()}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <th class="align-middle">
                        {{__('fields.is_translatable')}}
                    </th>
                    <td>
                        <select class="form-control form-control-sm" wire:model.defer="attribute.is_translatable"
                                wire:loading.attr="disabled">
                            <option>{{__('fields.choose')}}</option>
                            @foreach(\App\Enum\DefaultStatusEnum::cases() as $status)
                                <option value="{{$status->value}}">{{$status->label()}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        @if ($attribute->id ?? null)

                            <button wire:click="submit" class="btn btn-success me-2" type="button"
                                    wire:loading.attr="disabled">{{ucfirst(__('forms.save'))}}</button>

                            <button wire:click="delete" class="btn btn-danger me-2" type="button"
                                    wire:loading.attr="disabled">{{ucfirst(__('forms.delete'))}}</button>

                            <span wire:loading wire:target="delete"><i class="fas fa-loader fa-spin"></i></span>

                        @else
                            <button wire:click="submit" class="btn btn-success me-2" type="button"
                                    wire:loading.attr="disabled">{{ucfirst(__('forms.create'))}}</button>
                        @endif

                        <span wire:loading wire:target="submit"><i class="fas fa-loader fa-spin"></i></span>


                    </td>
                </tr>
            </table>
        </div>


    </div>

</div>
