@php $editing = isset($donation) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="description"
            label="Description"
            :value="old('description', ($editing ? $donation->description : ''))"
            maxlength="255"
            placeholder="Description"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select
            name="donation_detales_id"
            label="Donation Detales"
            required
        >
            @php $selected = old('donation_detales_id', ($editing ? $donation->donation_detales_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Donation Detales</option>
            @foreach($allDonationDetales as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
