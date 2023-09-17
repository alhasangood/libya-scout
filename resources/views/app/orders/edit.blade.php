@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('orders.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.orders.edit_title')
            </h4>

            <x-form
                method="PUT"
                action="{{ route('orders.update', $order) }}"
                class="mt-4"
            >
                @include('app.orders.form-inputs')

                <div class="mt-4">
                    <a href="{{ route('orders.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <a
                        href="{{ route('orders.create') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-add text-primary"></i>
                        @lang('crud.common.create')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.update')
                    </button>
                </div>
            </x-form>
        </div>
    </div>

    @can('view-any', App\Models\item_order::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Items</h4>

            <livewire:order-items-detail :order="$order" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\order_store_house::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Store Houses</h4>

            <livewire:order-store-houses-detail :order="$order" />
        </div>
    </div>
    @endcan
</div>
@endsection
