<div>
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-hover table-striped">
                @if ($exportSystem ?? null)
                    <tr>
                        <th class="wd-10p align-middle">
                            ID
                        </th>
                        <td class="align-middle">
                            <input type="text" disabled value="{{$exportSystem->id}}" class="form-control form-control-sm">
                        </td>
                    </tr>
                @endif

                <tr>
                    <th class="align-middle">
                        {{__('fields.logo')}}
                    </th>
                    <td>
                        @if ($logo)
                            <img src="{{ $logo->temporaryUrl() }}" alt="">
                        @elseif($exportSystem->logo ?? null)
                            <img src="{{url('/storage/'.$exportSystem->logo)}}" alt="{{ $exportSystem->name }}">
                        @endif

                        <x-forms.file model="logo" type="file" :defer="true"/>
                        <span wire:loading wire:target="logo"><i class="fas fa-loader fa-spin"></i></span>
                    </td>
                </tr>

                <x-forms.row model="exportSystem.name.en" description="{{__('fields.name')}} en" type="input"/>
                <x-forms.row model="exportSystem.name.ru" description="{{__('fields.name')}} ru" type="input"/>
                <x-forms.row model="exportSystem.slug" description="{{__('fields.slug')}}" type="input"/>
                <x-forms.row model="exportSystem.handler" description="{{__('fields.handler')}}" type="select"
                             :values="$baseExportSystem->getHandlers()"/>
                <tr>
                    <th class="align-middle">
                        {{__('fields.status')}}
                    </th>
                    <td>
                        <select class="form-control form-control-sm" wire:model="exportSystem.status"
                                wire:loading.attr="disabled">
                            <option>{{__('fields.choose')}}</option>
                            @foreach(\App\Enum\DefaultStatusEnum::cases() as $status)
                                <option value="{{$status->value}}">{{$status->label()}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                @if ($currentHandler ?? null)
                    @foreach($currentHandler->params as $key=>$param)
                        <tr>
                            <th class="align-middle">
                                {{__($param['description'])}}
                            </th>
                            <td>
                                <input wire:model.defer="settings.{{$key}}"
                                       @if ($param['secret'] === true) type="password" @else type="text"
                                       @endif class="form-control form-control-sm">
                            </td>
                        </tr>
                    @endforeach

                        <tr>
                            <th class="align-middle">
                                {{__('export_system.balance')}}
                            </th>
                            <td>
                                <input type="text" readonly value="{{ $balance }}" class="form-control form-control-sm">
                            </td>
                        </tr>
                @endif
                <tr>
                    <td colspan="2">
                        @if ($exportSystem->id ?? null)

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


        <div class="col-sm-6">
            <h2>{{ucfirst(__('forms.export_system_product'))}}</h2>
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>UNIQUE</th>
                    <th>NAME</th>
                    <th>PRICE</th>
                    <th>MIN</th>
                    <th>MAX</th>
                </tr>
                </thead>
                @foreach($exportSystem->exportSystemProducts as $exportSystemProduct)
                    <tr>
                        <td>{{$exportSystemProduct->id}}</td>
                        <td>{{$exportSystemProduct->unique_id}}</td>
                        <td>{{$exportSystemProduct->name}}</td>
                        <td>{{$exportSystemProduct->price}}</td>
                        <td>{{$exportSystemProduct->min}}</td>
                        <td>{{$exportSystemProduct->max}}</td>
                    </tr>
                @endforeach
            </table>
        </div>


    </div>

</div>
