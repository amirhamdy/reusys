<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.customers.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    @lang('crud.customers.index_title')
                </x-slot>

                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Customer::class)
                            <a
                                href="{{ route('customers.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.phone')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.email')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.fax')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.address')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.billing_address')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.postal_code')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.website')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.city')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.customer_status_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.country_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.region_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.customer_rating_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.industry_id')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($customers as $customer)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $customer->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $customer->phone ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $customer->email ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $customer->fax ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $customer->address ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $customer->billing_address ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $customer->postal_code ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $customer->website ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $customer->city ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($customer->customerStatus)->name
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($customer->country)->name ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($customer->region)->name ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($customer->customerRating)->name
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($customer->industry)->name ??
                                    '-' }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $customer)
                                        <a
                                            href="{{ route('customers.edit', $customer) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $customer)
                                        <a
                                            href="{{ route('customers.show', $customer) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $customer)
                                        <form
                                            action="{{ route('customers.destroy', $customer) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="15">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="15">
                                    <div class="mt-10 px-4">
                                        {!! $customers->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
