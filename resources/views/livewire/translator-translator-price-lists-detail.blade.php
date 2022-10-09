<div>
    <div>
        @can('create', App\Models\TranslatorPriceList::class)
        <button class="button" wire:click="newTranslatorPriceList">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\TranslatorPriceList::class)
        <button
            class="button button-danger"
             {{ empty($selected) ? 'disabled' : '' }} 
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="mr-1 icon ion-md-trash text-primary"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal wire:model="showingModal">
        <div class="px-6 py-4">
            <div class="text-lg font-bold">{{ $modalTitle }}</div>

            <div class="mt-5">
                <div>
                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="translatorPriceList.task_type_id"
                            label="Task Type"
                            wire:model="translatorPriceList.task_type_id"
                        >
                            <option value="null" disabled>Please select the Task Type</option>
                            @foreach($taskTypesForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-6/12">
                        <x-inputs.select
                            name="translatorPriceList.source_language_id"
                            label="Source Language"
                            wire:model="translatorPriceList.source_language_id"
                        >
                            <option value="null" disabled>Please select the Language</option>
                            @foreach($languagesForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-6/12">
                        <x-inputs.select
                            name="translatorPriceList.target_language_id"
                            label="Target Language"
                            wire:model="translatorPriceList.target_language_id"
                        >
                            <option value="null" disabled>Please select the Language</option>
                            @foreach($languagesForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-4/12">
                        <x-inputs.select
                            name="translatorPriceList.subject_matter_id"
                            label="Subject Matter"
                            wire:model="translatorPriceList.subject_matter_id"
                        >
                            <option value="null" disabled>Please select the Subject Matter</option>
                            @foreach($subjectMattersForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-4/12">
                        <x-inputs.select
                            name="translatorPriceList.currency_id"
                            label="Currency"
                            wire:model="translatorPriceList.currency_id"
                        >
                            <option value="null" disabled>Please select the Currency</option>
                            @foreach($currenciesForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-4/12">
                        <x-inputs.select
                            name="translatorPriceList.task_unit_id"
                            label="Task Unit"
                            wire:model="translatorPriceList.task_unit_id"
                        >
                            <option value="null" disabled>Please select the Task Unit</option>
                            @foreach($taskUnitsForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-6/12">
                        <x-inputs.number
                            name="translatorPriceList.unit_price"
                            label="Unit Price"
                            wire:model="translatorPriceList.unit_price"
                            max="255"
                            placeholder="Unit Price"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-6/12">
                        <x-inputs.number
                            name="translatorPriceList.minimum_charge"
                            label="Minimum Charge"
                            wire:model="translatorPriceList.minimum_charge"
                            max="255"
                            placeholder="Minimum Charge"
                        ></x-inputs.number>
                    </x-inputs.group>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 flex justify-between">
            <button
                type="button"
                class="button"
                wire:click="$toggle('showingModal')"
            >
                <i class="mr-1 icon ion-md-close"></i>
                @lang('crud.common.cancel')
            </button>

            <button
                type="button"
                class="button button-primary"
                wire:click="save"
            >
                <i class="mr-1 icon ion-md-save"></i>
                @lang('crud.common.save')
            </button>
        </div>
    </x-modal>

    <div class="block w-full overflow-auto scrolling-touch mt-4">
        <table class="w-full max-w-full mb-4 bg-transparent">
            <thead class="text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left w-1">
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.translator_translator_price_lists.inputs.task_type_id')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.translator_translator_price_lists.inputs.source_language_id')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.translator_translator_price_lists.inputs.target_language_id')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.translator_translator_price_lists.inputs.subject_matter_id')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.translator_translator_price_lists.inputs.currency_id')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.translator_translator_price_lists.inputs.task_unit_id')
                    </th>
                    <th class="px-4 py-3 text-right">
                        @lang('crud.translator_translator_price_lists.inputs.unit_price')
                    </th>
                    <th class="px-4 py-3 text-right">
                        @lang('crud.translator_translator_price_lists.inputs.minimum_charge')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($translatorPriceLists as $translatorPriceList)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $translatorPriceList->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($translatorPriceList->taskType)->name ?? '-'
                        }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($translatorPriceList->sourceLanguage)->name
                        ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($translatorPriceList->targetLanguage)->name
                        ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($translatorPriceList->subjectMatter)->name
                        ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($translatorPriceList->currency)->name ?? '-'
                        }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($translatorPriceList->taskUnit)->name ?? '-'
                        }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $translatorPriceList->unit_price ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $translatorPriceList->minimum_charge ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $translatorPriceList)
                            <button
                                type="button"
                                class="button"
                                wire:click="editTranslatorPriceList({{ $translatorPriceList->id }})"
                            >
                                <i class="icon ion-md-create"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9">
                        <div class="mt-10 px-4">
                            {{ $translatorPriceLists->render() }}
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
