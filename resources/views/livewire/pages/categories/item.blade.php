<tr xmlns:wire="http://www.w3.org/1999/xhtml">
    <td>{{ $category->id }}</td>
    <td>
        @if ($category->logo ?? null)
            <img src="{{url('/storage/'.$category->logo)}}" alt="{{ $category->name }}">
        @endif

        <label class="custom-file-upload">
            <i class="fas fa-cloud-arrow-up"></i>
            <input type="file" wire:model="logo">
        </label>

        <span wire:loading wire:target="logo"><i class="fas fa-loader fa-spin"></i></span>
    </td>
    <td>

        <a href="{{route('categories', ['id'=>$category])}}">{{$category->name}}</a>
        <!--
        @foreach(config('app.locales') as $lang)
            {{$lang}} <input type="text" wire:model.lazy="category.name.{{$lang}}" class="form-control form-control-sm"
               wire:loading.attr="disabled">

        @endforeach
        -->
    </td>
    <td>
        <input type="text" wire:model.lazy="category.slug" class="form-control form-control-sm"
               wire:loading.attr="disabled">
    </td>
    <td>
        <input type="text" wire:model.lazy="category.sort" class="form-control form-control-sm"
               wire:loading.attr="disabled">
    </td>
    <td>{{ $category->created_at }}</td>
    <td>{{ $category->updated_at }}</td>
    <td>
        <select class="form-control form-control-sm" wire:model="category.category_id" wire:loading.attr="disabled">
            <option value="">{{__('parent')}}</option>
            @foreach($allCategories as $categoryItem)
                <option value="{{$categoryItem->id}}">{{$categoryItem->name}}</option>
            @endforeach
        </select>
    </td>
    <td>
        <a href="{{ route('categories.edit', ['category'=>$category->id]) }}" class="me-1">
            <i class="fas fa-pencil"></i>
        </a>
        @if (!$deleteLoading)
            <span class="cursor-pointer" wire:click="delete({{$category->id}})" wire:loading.remove>
                <i class="fas fa-trash"></i>
            </span>
            <span wire:loading wire:target="delete({{$category->id}})"><i class="fas fa-loader fa-spin"></i></span>
        @endif
    </td>
</tr>
