@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-donation-detales.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.all_donation_detales.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.all_donation_detales.inputs.name')</h5>
                    <span>{{ $donationDetales->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_donation_detales.inputs.person')</h5>
                    <span>{{ $donationDetales->person ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.all_donation_detales.inputs.phone_number')
                    </h5>
                    <span>{{ $donationDetales->phone_number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.all_donation_detales.inputs.donation_entity_id')
                    </h5>
                    <span
                        >{{ optional($donationDetales->donationEntity)->name ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_donation_detales.inputs.logo')</h5>
                    <x-partials.thumbnail
                        src="{{ $donationDetales->logo ? \Storage::url($donationDetales->logo) : '' }}"
                        size="150"
                    />
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('all-donation-detales.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\DonationDetales::class)
                <a
                    href="{{ route('all-donation-detales.create') }}"
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
