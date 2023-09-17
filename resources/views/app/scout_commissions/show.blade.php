<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.scout_commissions.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a
                        href="{{ route('scout-commissions.index') }}"
                        class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                    @lang('crud.scout_commissions.show_title')
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.scout_commissions.inputs.name')
                        </h5>
                        <span>{{ $scoutCommission->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.scout_commissions.inputs.phone_number')
                        </h5>
                        <span>{{ $scoutCommission->phone_number ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a
                        href="{{ route('scout-commissions.index') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\ScoutCommission::class)
                    <a
                        href="{{ route('scout-commissions.create') }}"
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
