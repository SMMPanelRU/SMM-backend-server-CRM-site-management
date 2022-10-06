<div wire:loading.class="opacity-25" wire:target="search">
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
        @if ($settings['create_route'] ?? null)
            <div class="col-sm-12 col-md-6 text-end">
                <a href="{{ $settings['create_route']}}"><i class="fas fa-plus"></i></a>
            </div>
        @endif

    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover table-striped ">
                <thead>
                @foreach($columns as $index => $column)
                    <th class="{{ $column['class'] ?? 'align-middle' }}">
                        @switch($column['filter'])
                            @case('text')
                                <input type="text" class="form-control form-control-sm"
                                       wire:model.lazy="search.filters.{{ $column['name'] }}"
                                       placeholder="{{ $column['placeholder'] ?? $column['name'] }}">
                                @break
                            @case('select')
                                <select class="form-control form-control-sm" wire:model.lazy="search.filters.{{ $column['name'] }}">
                                    <option value="">{{ $column['placeholder'] ?? $column['name'] }}</option>
                                    @foreach($column['value'] as $key=>$value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                @break
                            @default
                                {{ $column['placeholder'] ?? $column['name'] }}
                        @endswitch
                    </th>
                @endforeach
                </thead>
                <tbody class="">
                @foreach($rows as $row)
                    @livewire($settings['liveware_path'], [$settings['item_key'] => $row], key($row->id))
                @endforeach
                </tbody>
            </table>
            <div class="overlay-spinner text-center" wire:loading wire:target="search">
                <div class="fa-3x"><i class="fas fa-loader fa-spin"></i></div>
            </div>
        </div>
    </div>

    @if(method_exists($rows, 'links'))
        {{ $rows->links('livewire.includes.pagination') }}
    @endif

</div>
