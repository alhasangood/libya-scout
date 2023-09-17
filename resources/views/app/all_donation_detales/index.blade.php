<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.all_donation_detales.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    @lang('crud.all_donation_detales.index_title')
                </x-slot>

                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\DonationDetales::class)
                            <a
                                href="{{ route('all-donation-detales.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_donation_detales.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_donation_detales.inputs.person')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_donation_detales.inputs.phone_number')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_donation_detales.inputs.donation_entity_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_donation_detales.inputs.logo')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($allDonationDetales as $donationDetales)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $donationDetales->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $donationDetales->person ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $donationDetales->phone_number ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{
                                    optional($donationDetales->donationEntity)->name
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $donationDetales->logo ? \Storage::url($donationDetales->logo) : '' }}"
                                    />
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $donationDetales)
                                        <a
                                            href="{{ route('all-donation-detales.edit', $donationDetales) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $donationDetales)
                                        <a
                                            href="{{ route('all-donation-detales.show', $donationDetales) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $donationDetales)
                                        <form
                                            action="{{ route('all-donation-detales.destroy', $donationDetales) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="mt-10 px-4">
                                        {!! $allDonationDetales->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
