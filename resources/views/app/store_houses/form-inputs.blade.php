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
        <x-inputs.select
            name="scout_regiment_id"
            label="Scout Regiment"
            required
        >
            @php $selected = old('scout_regiment_id', ($editing ? $storeHouse->scout_regiment_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Scout Regiment</option>
            @foreach($scoutRegiments as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
