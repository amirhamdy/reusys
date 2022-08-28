@php $editing = isset($customer) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $customer->name : '')) }}"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.text
            name="phone"
            label="Phone"
            value="{{ old('phone', ($editing ? $customer->phone : '')) }}"
            maxlength="255"
            placeholder="Phone"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $customer->email : '')) }}"
            maxlength="255"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.text
            name="fax"
            label="Fax"
            value="{{ old('fax', ($editing ? $customer->fax : '')) }}"
            maxlength="255"
            placeholder="Fax"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="address"
            label="Address"
            value="{{ old('address', ($editing ? $customer->address : '')) }}"
            maxlength="255"
            placeholder="Address"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="billing_address"
            label="Billing Address"
            value="{{ old('billing_address', ($editing ? $customer->billing_address : '')) }}"
            maxlength="255"
            placeholder="Billing Address"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.text
            name="postal_code"
            label="Postal Code"
            value="{{ old('postal_code', ($editing ? $customer->postal_code : '')) }}"
            maxlength="255"
            placeholder="Postal Code"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.text
            name="website"
            label="Website"
            value="{{ old('website', ($editing ? $customer->website : '')) }}"
            maxlength="255"
            placeholder="Website"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.text
            name="city"
            label="City"
            value="{{ old('city', ($editing ? $customer->city : '')) }}"
            maxlength="255"
            placeholder="City"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.select
            name="customer_status_id"
            label="Customer Status"
            required
        >
            @php $selected = old('customer_status_id', ($editing ? $customer->customer_status_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Customer Status</option>
            @foreach($customerStatuses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.select name="country_id" label="Country" required>
            @php $selected = old('country_id', ($editing ? $customer->country_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Country</option>
            @foreach($countries as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.select name="region_id" label="Region" required>
            @php $selected = old('region_id', ($editing ? $customer->region_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Region</option>
            @foreach($regions as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select
            name="customer_rating_id"
            label="Customer Rating"
            required
        >
            @php $selected = old('customer_rating_id', ($editing ? $customer->customer_rating_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Customer Rating</option>
            @foreach($customerRatings as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="industry_id" label="Industry" required>
            @php $selected = old('industry_id', ($editing ? $customer->industry_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Industry</option>
            @foreach($industries as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
