<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.store_houses.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('store-houses.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                    @lang('crud.store_houses.show_title')
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.store_houses.inputs.name')
                        </h5>
                        <span>{{ $storeHouse->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.store_houses.inputs.store_houseable_type')
                        </h5>
                        <span
                            >{{ $storeHouse->store_houseable_type ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.store_houses.inputs.store_houseable_id')
                        </h5>
                        <span
                            >{{ $storeHouse->store_houseable_id ?? '-' }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('store-houses.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\StoreHouse::class)
                    <a href="{{ route('store-houses.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
