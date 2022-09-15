<div>
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-hover table-striped">
                @if ($category ?? null)
                    <tr>
                        <th class="wd-10p">
                            ID
                        </th>
                        <td class="align-middle">
                            <input type="text" disabled value="{{$category->id}}" class="form-control form-control-sm">
                        </td>
                    </tr>
                @endif

                <tr>
                    <th>
                        {{__('fields.logo')}}
                    </th>
                    <td>
                        @if ($logo)
                            <img src="{{ $logo->temporaryUrl() }}" alt="">
                        @elseif($category->logo ?? null)
                            <img src="{{url('/storage/'.$category->logo)}}" alt="{{ $category->name }}">
                        @endif

                        <x-forms.file model="logo" type="file" :defer="true"/>
                        <span wire:loading wire:target="logo"><i class="fas fa-loader fa-spin"></i></span>
                    </td>
                </tr>

                <x-forms.row model="category.name.en" description="{{__('fields.name')}} en" type="input"/>
                <x-forms.row model="category.name.ru" description="{{__('fields.name')}} ru" type="input"/>
                <x-forms.row model="category.slug" description="{{__('fields.slug')}}" type="input"/>
                <x-forms.row model="category.sort" description="{{__('fields.sort')}}" type="input"/>
                <x-forms.row model="category.category_id" description="{{__('fields.parent')}}" type="select"
                             :values="$allCategories"/>

                <tr>
                    <th colspan="2">
                        @if ($category->id ?? null)

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
            <table class="table table-hover table-striped ">
                @foreach($allAttributes as $attribute)
                    @if ($attribute->type === \App\Enum\Attributes\AttributeTypesEnum::Text)
                        @foreach(config('app.locales') as $lang)
                            <tr>
                                <th class="wd-10p">
                                    {{$attribute->name}} {{$lang}}
                                </th>
                                <td class="align-middle">
                                    <x-forms.input model="attr.{{$attribute->slug}}.{{$lang}}" type="text"/>
                                </td>
                            </tr>
                        @endforeach
                    @elseif ($attribute->type === \App\Enum\Attributes\AttributeTypesEnum::Textarea)
                        @foreach(config('app.locales') as $lang)
                            <tr>
                                <th class="wd-10p">
                                    {{$attribute->name}} {{$lang}}
                                </th>
                                <td class="align-middle">
                                    <x-forms.textarea model="attr.{{$attribute->slug}}.{{$lang}}"/>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach

            </table>
        </div>
    </div>

</div>
