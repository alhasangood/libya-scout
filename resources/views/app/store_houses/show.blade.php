@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('store-houses.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.store_houses.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.store_houses.inputs.name')</h5>
                    <span>{{ $storeHouse->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.store_houses.inputs.store_houseable_id')
                    </h5>
                    <span>{{ $storeHouse->store_houseable_id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.store_houses.inputs.store_houseable_type')
                    </h5>
                    <span>{{ $storeHouse->store_houseable_type ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('store-houses.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\StoreHouse::class)
                <a
                    href="{{ route('store-houses.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection