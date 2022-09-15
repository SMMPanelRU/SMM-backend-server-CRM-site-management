<div>
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-hover table-striped">
                @if ($page ?? null)
                    <tr>
                        <th class="wd-10p align-middle">
                            ID
                        </th>
                        <td class="align-middle">
                            <input type="text" disabled value="{{$page->id}}" class="form-control form-control-sm">
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
                        @elseif($page->logo ?? null)
                            <img src="{{url('/storage/'.$page->logo)}}" alt="{{ $page->name }}">
                        @endif

                        <x-forms.file model="logo" type="file" :defer="true"/>
                        <span wire:loading wire:target="logo"><i class="fas fa-loader fa-spin"></i></span>
                    </td>
                </tr>

                <x-forms.row model="page.name.en" description="{{__('fields.name')}} en" type="input"/>
                <x-forms.row model="page.name.ru" description="{{__('fields.name')}} ru" type="input"/>
                <x-forms.row model="page.slug" description="{{__('fields.slug')}}" type="input"/>

                <x-forms.row model="page.short_description.en" description="{{__('fields.short_description')}} en"
                             type="textarea"/>
                <x-forms.row model="page.short_description.ru" description="{{__('fields.short_description')}} ru"
                             type="textarea"/>

                <x-forms.row model="page.description.en" description="{{__('fields.description')}} en"
                             type="html"/>

                <x-forms.row model="page.description.ru" description="{{__('fields.description')}} ru"
                             type="html"/>

                <tr>
                    <th class="align-middle">
                        {{__('fields.status')}}
                    </th>
                    <td>
                        <select class="form-control form-control-sm" wire:model.defer="page.status"
                                wire:loading.attr="disabled">
                            <option>{{__('fields.choose')}}</option>
                            @foreach(\App\Enum\DefaultStatusEnum::cases() as $status)
                                <option value="{{$status->value}}">{{$status->label()}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                    <tr>
                        <th class="wd-10p">
                            {{__('sites')}}
                        </th>
                        <td class="align-middle">
                            @foreach($allSites as $site)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" wire:model.defer="sites" class="form-check-input"
                                           id="site-{{$site->id}}" value="{{$site->id}}"
                                           @if(in_array($site->id, $sites)) checked @endif>
                                    <label class="form-check-label" for="site-{{$site->id}}">
                                        {{$site->name}}
                                    </label>
                                </div>
                            @endforeach

                        </td>
                    </tr>

                <tr>
                    <td colspan="2">
                        @if ($page->id ?? null)

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
            <table class="table table-hover table-striped ">
                <x-forms.attributes-edit :allAttributes="$allAttributes"/>
            </table>
        </div>


    </div>

</div>
