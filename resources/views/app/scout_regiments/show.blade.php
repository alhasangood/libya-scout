@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('scout-regiments.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.scout_regiments.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.scout_regiments.inputs.name')</h5>
                    <span>{{ $scoutRegiment->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.scout_regiments.inputs.phone_number')</h5>
                    <span>{{ $scoutRegiment->phone_number ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('scout-regiments.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\ScoutRegiment::class)
                <a
                    href="{{ route('scout-regiments.create') }}"
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
