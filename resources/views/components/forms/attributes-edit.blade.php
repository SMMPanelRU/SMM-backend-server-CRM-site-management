@foreach($allAttributes as $attribute)
    @if ($attribute->type === \App\Enum\Attributes\AttributeTypesEnum::Text)
        @if ($attribute->is_translatable)
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
        @else
            <tr>
                <th class="wd-10p">
                    {{$attribute->name}}
                </th>
                <td class="align-middle">
                    <x-forms.input model="attr.{{$attribute->slug}}" type="text"/>
                </td>
            </tr>
        @endif
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

    @elseif ($attribute->type === \App\Enum\Attributes\AttributeTypesEnum::Select)
        <tr>
            <th class="wd-10p">
                {{$attribute->name}}
            </th>
            <td>
                <x-forms.select model="attr.{{$attribute->slug}}"
                                :values="$attribute->predefinedValues()->pluck('value', 'id')"/>
            </td>
        </tr>
    @endif
@endforeach
