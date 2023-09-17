@php $editing = isset($itemDetails) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $itemDetails->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="item_id" label="Item" required>
            @php $selected = old('item_id', ($editing ? $itemDetails->item_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Item</option>
            @foreach($items as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="qtuantity"
            label="Qtuantity"
            :value="old('qtuantity', ($editing ? $itemDetails->qtuantity : ''))"
            max="255"
            placeholder="Qtuantity"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="unit"
            label="Unit"
            :value="old('unit', ($editing ? $itemDetails->unit : ''))"
            maxlength="255"
            placeholder="Unit"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
