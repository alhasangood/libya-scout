@php $editing = isset($order) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="orederNumber"
            label="Oreder Number"
            :value="old('orederNumber', ($editing ? $order->orederNumber : ''))"
            maxlength="255"
            placeholder="Oreder Number"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="transprter_id" label="Transprter" required>
            @php $selected = old('transprter_id', ($editing ? $order->transprter_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Transprter</option>
            @foreach($transprters as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
