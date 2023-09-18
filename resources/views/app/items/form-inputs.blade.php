@php $editing = isset($item) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $item->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="store_house_id" label="Store House" required>
            @php $selected = old('store_house_id', ($editing ? $item->store_house_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Store House</option>
            @foreach($storeHouses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
