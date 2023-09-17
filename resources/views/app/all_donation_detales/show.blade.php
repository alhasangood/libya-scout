<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.all_donation_detales.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a
                        href="{{ route('all-donation-detales.index') }}"
                        class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                    @lang('crud.all_donation_detales.show_title')
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.all_donation_detales.inputs.name')
                        </h5>
                        <span>{{ $donationDetales->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.all_donation_detales.inputs.person')
                        </h5>
                        <span>{{ $donationDetales->person ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.all_donation_detales.inputs.phone_number')
                        </h5>
                        <span>{{ $donationDetales->phone_number ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.all_donation_detales.inputs.donation_entity_id')
                        </h5>
                        <span
                            >{{ optional($donationDetales->donationEntity)->name
                            ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.all_donation_detales.inputs.logo')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $donationDetales->logo ? \Storage::url($donationDetales->logo) : '' }}"
                            size="150"
                        />
                    </div>
                </div>

                <div class="mt-10">
                    <a
                        href="{{ route('all-donation-detales.index') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\DonationDetales::class)
                    <a
                        href="{{ route('all-donation-detales.create') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
