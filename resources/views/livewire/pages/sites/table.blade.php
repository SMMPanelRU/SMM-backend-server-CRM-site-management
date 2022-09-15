<div xmlns:wire="http://www.w3.org/1999/xhtml" wire:loading.class="opacity-25" wire:target="search">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="dataTables_length" id="dataTableExample_length">
                <label class="d-inline-block">{{__('show')}}
                    <select
                        wire:model="search.limit"
                        class="form-select form-select-sm d-inline-block w-auto mx-2">
                        <option value="10">10</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="-1">All</option>
                    </select>
                    {{__('entries')}}
                </label>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 text-end">
            <button class="btn btn-primary" wire:click="create" wire:loading.remove><i class="fas fa-plus"></i> </button>
            <span wire:loading wire:target="create"><i class="fas fa-loader fa-spin"></i></span>
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
                               wire:model.lazy="search.filters.url" placeholder="{{__('url')}}">
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
                        <select class="form-control form-control-sm" wire:model="search.filters.status">
                            <option>{{__('status')}}</option>
                            @foreach(\App\Enum\DefaultStatusEnum::cases() as $status)
                                <option value="{{$status->value}}">{{$status->label()}}</option>
                            @endforeach
                        </select>
                    </th>
                    <th class="align-middle">
                        {{__('api key')}}
                    </th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="">
                @foreach($sites as $site)
                    @livewire('pages.sites.site-item', ['site' => $site], key($site->id))
                @endforeach
                </tbody>
            </table>
            <div class="overlay-spinner text-center" wire:loading wire:target="search">
                <div class="fa-3x"><i class="fas fa-loader fa-spin"></i></div>
            </div>
        </div>
    </div>

    @if(method_exists($sites, 'links'))
        {{ $sites->links('livewire.includes.pagination') }}
    @endif

</div>
