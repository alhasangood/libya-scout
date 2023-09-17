@php $editing = isset($storeHouse) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $storeHouse->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="store_houseable_id" label="Store Houseable Id">
            @php $selected = old('store_houseable_id', ($editing ? $storeHouse->store_houseable_id : '')) @endphp
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="store_houseable_type"
            label="Store Houseable Type"
        >
            @php $selected = old('store_houseable_type', ($editing ? $storeHouse->store_houseable_type : '')) @endphp
        </x-inputs.select>
    </x-inputs.group>
</div>
