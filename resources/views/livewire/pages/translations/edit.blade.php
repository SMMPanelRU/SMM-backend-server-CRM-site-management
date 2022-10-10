<div>
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-hover table-striped">
                @if ($translation ?? null)
                    <tr>
                        <th class="wd-10p">
                            ID
                        </th>
                        <td class="align-middle">
                            <input type="text" disabled value="{{$translation->id}}"
                                   class="form-control form-control-sm">
                        </td>
                    </tr>
                @endif

                <x-forms.row model="translation.group" description="{{__('fields.group')}}" type="input"/>
                <x-forms.row model="translation.key" description="{{__('fields.key')}}" type="input"/>
                <x-forms.row model="translation.text.en" description="{{__('fields.text')}} en" type="input"/>
                <x-forms.row model="translation.text.ru" description="{{__('fields.text')}} ru" type="input"/>

                <tr>
                    <th colspan="2">
                        @if ($translation->id ?? null)

                            <button wire:click="submit" class="btn btn-success me-2" type="button"
                                    wire:loading.attr="disabled">{{ucfirst(__('forms.save'))}}</button>

                        @else
                            <button wire:click="submit" class="btn btn-success me-2" type="button"
                                    wire:loading.attr="disabled">{{ucfirst(__('forms.create'))}}</button>
                        @endif

                        <span wire:loading wire:target="submit"><i class="fas fa-loader fa-spin"></i></span>


                    </th>
                </tr>
            </table>
        </div>
    </div>


</div>
