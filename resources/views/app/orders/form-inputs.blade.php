@php $editing = isset($order) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="orederNumber"
            label="Oreder Number"
            :value="old('orederNumber', ($editing ? $order->orederNumber : ''))"
            maxlength="255"
            placeholder="Oreder Number"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="from"
            label="From"
            :value="old('from', ($editing ? $order->from : ''))"
            maxlength="255"
            placeholder="From"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="to"
            label="To"
            :value="old('to', ($editing ? $order->to : ''))"
            maxlength="255"
            placeholder="To"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
