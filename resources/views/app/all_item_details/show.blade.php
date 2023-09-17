@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-item-details.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.all_item_details.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.all_item_details.inputs.name')</h5>
                    <span>{{ $itemDetails->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_item_details.inputs.item_id')</h5>
                    <span>{{ optional($itemDetails->item)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_item_details.inputs.qtuantity')</h5>
                    <span>{{ $itemDetails->qtuantity ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_item_details.inputs.unit')</h5>
                    <span>{{ $itemDetails->unit ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('all-item-details.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\ItemDetails::class)
                <a
                    href="{{ route('all-item-details.create') }}"
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
