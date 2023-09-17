<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.all_item_details.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('all-item-details.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                    @lang('crud.all_item_details.show_title')
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.all_item_details.inputs.name')
                        </h5>
                        <span>{{ $itemDetails->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.all_item_details.inputs.item_id')
                        </h5>
                        <span
                            >{{ optional($itemDetails->item)->name ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.all_item_details.inputs.qtuantity')
                        </h5>
                        <span>{{ $itemDetails->qtuantity ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.all_item_details.inputs.unit')
                        </h5>
                        <span>{{ $itemDetails->unit ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a
                        href="{{ route('all-item-details.index') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\ItemDetails::class)
                    <a
                        href="{{ route('all-item-details.create') }}"
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
