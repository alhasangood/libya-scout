@php $editing = isset($scoutCommission) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $scoutCommission->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="phone_number"
            label="Phone Number"
            :value="old('phone_number', ($editing ? $scoutCommission->phone_number : ''))"
            maxlength="255"
            placeholder="Phone Number"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
