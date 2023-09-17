<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.transprters.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('transprters.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                    @lang('crud.transprters.show_title')
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.transprters.inputs.name')
                        </h5>
                        <span>{{ $transprter->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.transprters.inputs.identity')
                        </h5>
                        <span>{{ $transprter->identity ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.transprters.inputs.address')
                        </h5>
                        <span>{{ $transprter->address ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.transprters.inputs.transprter_type_id')
                        </h5>
                        <span
                            >{{ optional($transprter->item)->name ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.transprters.inputs.photo')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $transprter->photo ? \Storage::url($transprter->photo) : '' }}"
                            size="150"
                        />
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('transprters.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Transprter::class)
                    <a href="{{ route('transprters.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
