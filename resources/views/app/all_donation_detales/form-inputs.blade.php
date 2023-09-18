@php $editing = isset($donationDetales) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select
            name="donation_entity_id"
            label="Donation Entity"
            required
        >
            @php $selected = old('donation_entity_id', ($editing ? $donationDetales->donation_entity_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Donation Entity</option>
            @foreach($donationEntities as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $donationDetales->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="person"
            label="Person"
            :value="old('person', ($editing ? $donationDetales->person : ''))"
            maxlength="255"
            placeholder="Person"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="logo"
            label="Logo"
            :value="old('logo', ($editing ? $donationDetales->logo : ''))"
            maxlength="255"
            placeholder="Logo"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="number"
            label="Number"
            :value="old('number', ($editing ? $donationDetales->number : ''))"
            maxlength="255"
            placeholder="Number"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
