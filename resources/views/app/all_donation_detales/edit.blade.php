<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.all_donation_detales.edit_title')
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
                    @lang('crud.all_donation_detales.edit_title')
                </x-slot>

                <x-form
                    method="PUT"
                    action="{{ route('all-donation-detales.update', $donationDetales) }}"
                    has-files
                    class="mt-4"
                >
                    @include('app.all_donation_detales.form-inputs')

                    <div class="mt-10">
                        <a
                            href="{{ route('all-donation-detales.index') }}"
                            class="button"
                        >
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

                        <a
                            href="{{ route('all-donation-detales.create') }}"
                            class="button"
                        >
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
        </div>
    </div>
</x-app-layout>
