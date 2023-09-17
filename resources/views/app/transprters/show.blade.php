@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('transprters.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.transprters.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.transprters.inputs.name')</h5>
                    <span>{{ $transprter->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.transprters.inputs.identity')</h5>
                    <span>{{ $transprter->identity ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.transprters.inputs.address')</h5>
                    <span>{{ $transprter->address ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.transprters.inputs.transprter_type_id')</h5>
                    <span>{{ optional($transprter->item)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.transprters.inputs.photo')</h5>
                    <x-partials.thumbnail
                        src="{{ $transprter->photo ? \Storage::url($transprter->photo) : '' }}"
                        size="150"
                    />
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('transprters.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Transprter::class)
                <a
                    href="{{ route('transprters.create') }}"
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
