@section('breadcrumbs')
    @if ($parent)
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-arrow">
                <li class="breadcrumb-item"><a href="{{ route('categories')}}">{{ucfirst(__('categories'))}}</a></li>
                <li class="breadcrumb-item active">{{$parent->name}}</li>
            </ol>
        </nav>
    @endif
@endsection

<div xmlns:wire="http://www.w3.org/1999/xhtml" wire:loading.class="opacity-25" wire:target="search">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="dataTables_length" id="dataTableExample_length">
                <label class="d-inline-block">{{__('pagination.show')}}
                    <select
                        wire:model="search.limit"
                        class="form-select form-select-sm d-inline-block w-auto mx-2">
                        <option value="10">10</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="-1">All</option>
                    </select>
                    {{__('pagination.entries')}}
                </label>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 text-end">
            <a href="{{ route('categories.edit')}}"><i class="fas fa-plus"></i></a>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover table-striped ">
                <thead>
                <tr>
                    <th class="wd-10p">
                        <input type="text" class="form-control form-control-sm"
                               wire:model.lazy="search.filters.id" placeholder="#">
                    </th>
                    <th class="align-middle">
                        {{__('logo')}}
                    </th>
                    <th>
                        <input type="text" class="form-control form-control-sm"
                               wire:model.lazy="search.filters.name" placeholder="{{__('name')}}">
                    </th>
                    <th>
                        <input type="text" class="form-control form-control-sm"
                               wire:model.lazy="search.filters.slug" placeholder="{{__('slug')}}">
                    </th>
                    <th class="align-middle">
                        {{__('sort')}}
                    </th>
                    <th>
                        <input type="text" class="form-control form-control-sm datepicker-range"
                               wire:model="search.filters.created_at" placeholder="{{__('created')}}">
                    </th>
                    <th>
                        <input type="text" class="form-control form-control-sm datepicker-range"
                               wire:model="search.filters.updated_at" placeholder="{{__('updated')}}">
                    </th>
                    <th>
                        {{__('parent')}}
                    </th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="">
                @foreach($categories as $category)
                    @livewire('pages.categories.category-item', ['category' => $category, 'allCategories'=>$allCategories], key($category->id))
                @endforeach
                </tbody>
            </table>
            <div class="overlay-spinner text-center" wire:loading wire:target="search">
                <div class="fa-3x"><i class="fas fa-loader fa-spin"></i></div>
            </div>
        </div>
    </div>

    @if(method_exists($categories, 'links'))
        {{ $categories->links('livewire.includes.pagination') }}
    @endif

</div>
