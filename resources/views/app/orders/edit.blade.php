<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.orders.edit_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('orders.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                    @lang('crud.orders.edit_title')
                </x-slot>

                <x-form
                    method="PUT"
                    action="{{ route('orders.update', $order) }}"
                    class="mt-4"
                >
                    @include('app.orders.form-inputs')

                    <div class="mt-10">
                        <a href="{{ route('orders.index') }}" class="button">
                            <i
                                class="
                                    mr-1
                                    icon
                                    ion-md-return-left
                                    text-primary
                                "
                            ></i>
                            @lang('crud.common.back')
                        </a>

                        <a href="{{ route('orders.create') }}" class="button">
                            <i class="mr-1 icon ion-md-add text-primary"></i>
                            @lang('crud.common.create')
                        </a>

                        <button
                            type="submit"
                            class="button button-primary float-right"
                        >
                            <i class="mr-1 icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>
                    </div>
                </x-form>
            </x-partials.card>

            @can('view-any', App\Models\Item::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Items </x-slot>

                <livewire:order-items-detail :order="$order" />
            </x-partials.card>
            @endcan @can('view-any', App\Models\StoreHouse::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Store Houses </x-slot>

                <livewire:order-store-houses-detail :order="$order" />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
