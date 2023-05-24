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
                <x-forms.row model="product.multiplicity" description="{{__('fields.multiplicity')}}" type="input"/>
                <x-forms.row model="product.sort" description="{{__('fields.sort')}}" type="input"/>

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

                <tr>
                    <th class="wd-10p">
                        {{__('prices')}}
                    </th>
                    <td class="align-middle">
                        <table class="table table-hover table-striped">
                            <tr>
                                <td>{{__('site')}}</td>
                                <td>{{__('fields.price')}}</td>
                                <td>{{__('fields.old_price')}}</td>
                            </tr>
                            @foreach($allSites as $site)
                                <tr>
                                    <td>{{$site->name}}</td>
                                    <td>
                                        <x-forms.input type="text" model="prices.{{$site->id}}.price"/>
                                    </td>
                                    <td>
                                        <x-forms.input type="text" model="prices.{{$site->id}}.old_price"/>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>


            </table>
        </div>
    </div>


    <div class="row mt-4">

        <div class="col-sm-6">
            <h2>{{__('forms.export')}}</h2>
            <table class="table table-hover table-striped ">


                <tr>
                    <th>{{__('forms.export_system')}}</th>
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
                        <th>{{__('forms.export_system_product')}}</th>
                        <td>
                            <input type="text" class="form-control-sm form-control" wire:model="exportSystemProductSearch" placeholder="{{__('text.search')}}">

                            <span wire:loading wire:target="exportSystemProductSearch"><i class="fas fa-loader fa-spin"></i></span>

                            <select class="form-control-sm form-control"
                                    wire:model.defer="product.export_system_product_id">
                                <option value="">{{__('fields.choose')}}</option>
                                @foreach($exportSystemProducts as $exportSystemProduct)
                                    @php /** @var App\Models\ExportSystemProduct $exportSystemProduct */ @endphp
                                    <option value="{{$exportSystemProduct->id}}">{{$exportSystemProduct->unique_id}} {{$exportSystemProduct->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endif


            </table>

            @if ($product->id ?? null)
                <h2>{{__('forms.discounts')}}</h2>
                <table class="table table-hover table-striped ">

                    <thead>
                    <tr>
                        <th>{{__('text.count')}}</th>
                        <th>{{__('text.discount')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($discounts['existed'] as $discount)
                        <tr>
                            <td>
                                <x-forms.input type="text" model="discounts.existed.{{$discount['id']}}.count"/>
                            </td>
                            <td>
                                <x-forms.input type="text" model="discounts.existed.{{$discount['id']}}.discount"/>
                            </td>
                        </tr>
                    @endforeach
                    @foreach($discounts['new'] as $discount)
                        <tr>
                            <td>
                                <x-forms.input type="text" model="discounts.new.{{$loop->index}}.count"/>
                            </td>
                            <td>
                                <x-forms.input type="text" model="discounts.new.{{$loop->index}}.discount"/>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                    <tr>
                        <th></th>
                        <th>
                            <button wire:click="addEmptyDiscount" class="btn btn-primary me-2" type="button"
                                    wire:loading.attr="disabled">{{ucfirst(__('text.add'))}}</button>
                        </th>
                    </tr>
                    </tfoot>

                </table>
            @endif

            <table class="table table-hover table-striped ">
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
