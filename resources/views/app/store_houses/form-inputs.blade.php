@php $editing = isset($storeHouse) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $storeHouse->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="store_houseable_type"
            label="Store Houseable Type"
            :checked="old('store_houseable_type', ($editing ? $storeHouse->store_houseable_type : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="store_houseable_id" label="Store Houseable Id">
            @php $selected = old('store_houseable_id', ($editing ? $storeHouse->store_houseable_id : '')) @endphp
        </x-inputs.select>
    </x-inputs.group>
</div>
