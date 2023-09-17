@php $editing = isset($scoutRegiment) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $scoutRegiment->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="phone_number"
            label="Phone Number"
            :value="old('phone_number', ($editing ? $scoutRegiment->phone_number : ''))"
            maxlength="255"
            placeholder="Phone Number"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select
            name="scout_commission_id"
            label="Scout Commission"
            required
        >
            @php $selected = old('scout_commission_id', ($editing ? $scoutRegiment->scout_commission_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Scout Commission</option>
            @foreach($scoutCommissions as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
