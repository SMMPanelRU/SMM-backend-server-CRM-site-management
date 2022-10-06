<div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover table-striped">
                @if ($product ?? null)
                    <tr>
                        <th class="wd-10p">
                            ID
                        </th>
                        <td class="align-middle">
                            <input type="text" disabled value="{{$product->id}}" class="form-control form-control-sm">
                        </td>
                    </tr>
                @endif


                <x-forms.row model="product.name.en" description="{{__('fields.name')}} en" type="input"/>
                <x-forms.row model="product.name.ru" description="{{__('fields.name')}} ru" type="input"/>
                <x-forms.row model="product.slug" description="{{__('fields.slug')}}" type="input"/>
                <x-forms.row model="product.sort" description="{{__('fields.sort')}}" type="input"/>

                    <x-forms.row model="product.price" description="{{__('fields.price')}}" type="input"/>
                    <x-forms.row model="product.old_price" description="{{__('fields.old_price')}}" type="input"/>

                <x-forms.row model="product.short_description.en" description="{{__('fields.short_description')}} en"
                             type="textarea"/>
                <x-forms.row model="product.short_description.ru" description="{{__('fields.short_description')}} ru"
                             type="textarea"/>

                <x-forms.row model="product.description.en" description="{{__('fields.description')}} en"
                             type="html"/>

                <x-forms.row model="product.description.ru" description="{{__('fields.description')}} ru"
                             type="html"/>

                <tr>
                    <th class="wd-10p">
                        {{__('category')}}
                    </th>
                    <td class="align-middle">
                        <select multiple class="form-control form-control-sm" wire:model.defer="cats">
                            <option value="">Выберите</option>

                            @foreach($allCategories as $cat)
                                @if ($cat->category_id === null)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>

                                    @foreach($allCategories as $subCat)
                                        @if ($subCat->category_id === $cat->id)
                                            <option value="{{$subCat->id}}">{{$cat->name}} -> {{$subCat->name}}</option>
                                        @endif
                                    @endforeach
                                @endif
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


            </table>
        </div>
    </div>


    <div class="row mt-4">

        <div class="col-sm-6">
            <h2>{{__('form.export')}}</h2>
            <table class="table table-hover table-striped ">


                <tr>
                    <th>{{__('form.export_system')}}</th>
                    <td>
                        <select class="form-control-sm form-control" wire:model="exportSystem">
                            <option value="0">{{__('fields.choose')}}</option>
                            @foreach($allExportSystems as $exportSystem)
                                <option value="{{$exportSystem->id}}">{{$exportSystem->name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                @if ($exportSystemProducts ?? null)
                    <tr>
                        <th>{{__('form.export_system_product')}}</th>
                        <td>
                            <select class="form-control-sm form-control" wire:model.defer="product.export_system_product_id">
                                <option value="">{{__('fields.choose')}}</option>
                                @foreach($exportSystemProducts as $exportSystemProduct)
                                    <option value="{{$exportSystemProduct->id}}">{{$exportSystemProduct->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endif


                <tr>
                    <th colspan="2">
                        @if ($product->id ?? null)

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


                    </th>
                </tr>
            </table>
        </div>

        <div class="col-sm-6">
            <h2>{{__('forms.attributes')}}</h2>
            <table class="table table-hover table-striped ">

                <x-forms.attributes-edit :allAttributes="$allAttributes"/>


            </table>
        </div>
    </div>

</div>
