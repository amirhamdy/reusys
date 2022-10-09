<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TaskType;
use App\Models\Language;
use App\Models\Currency;
use App\Models\TaskUnit;
use App\Models\Translator;
use Livewire\WithPagination;
use App\Models\SubjectMatter;
use App\Models\TranslatorPriceList;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TranslatorTranslatorPriceListsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Translator $translator;
    public TranslatorPriceList $translatorPriceList;
    public $taskTypesForSelect = [];
    public $languagesForSelect = [];
    public $subjectMattersForSelect = [];
    public $currenciesForSelect = [];
    public $taskUnitsForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New TranslatorPriceList';

    protected $rules = [
        'translatorPriceList.task_type_id' => [
            'required',
            'exists:task_types,id',
        ],
        'translatorPriceList.source_language_id' => [
            'required',
            'exists:languages,id',
        ],
        'translatorPriceList.target_language_id' => [
            'required',
            'exists:languages,id',
        ],
        'translatorPriceList.subject_matter_id' => [
            'required',
            'exists:subject_matters,id',
        ],
        'translatorPriceList.currency_id' => [
            'required',
            'exists:currencies,id',
        ],
        'translatorPriceList.task_unit_id' => [
            'required',
            'exists:task_units,id',
        ],
        'translatorPriceList.unit_price' => ['required', 'numeric'],
        'translatorPriceList.minimum_charge' => ['required', 'numeric'],
    ];

    public function mount(Translator $translator)
    {
        $this->translator = $translator;
        $this->taskTypesForSelect = TaskType::pluck('name', 'id');
        $this->languagesForSelect = Language::pluck('name', 'id');
        $this->subjectMattersForSelect = SubjectMatter::pluck('name', 'id');
        $this->currenciesForSelect = Currency::pluck('name', 'id');
        $this->taskUnitsForSelect = TaskUnit::pluck('name', 'id');
        $this->resetTranslatorPriceListData();
    }

    public function resetTranslatorPriceListData()
    {
        $this->translatorPriceList = new TranslatorPriceList();

        $this->translatorPriceList->task_type_id = null;
        $this->translatorPriceList->source_language_id = null;
        $this->translatorPriceList->target_language_id = null;
        $this->translatorPriceList->subject_matter_id = null;
        $this->translatorPriceList->currency_id = null;
        $this->translatorPriceList->task_unit_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newTranslatorPriceList()
    {
        $this->editing = false;
        $this->modalTitle = trans(
            'crud.translator_translator_price_lists.new_title'
        );
        $this->resetTranslatorPriceListData();

        $this->showModal();
    }

    public function editTranslatorPriceList(
        TranslatorPriceList $translatorPriceList
    ) {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.translator_translator_price_lists.edit_title'
        );
        $this->translatorPriceList = $translatorPriceList;

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal()
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    public function save()
    {
        $this->validate();

        if (!$this->translatorPriceList->translator_id) {
            $this->authorize('create', TranslatorPriceList::class);

            $this->translatorPriceList->translator_id = $this->translator->id;
        } else {
            $this->authorize('update', $this->translatorPriceList);
        }

        $this->translatorPriceList->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', TranslatorPriceList::class);

        TranslatorPriceList::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetTranslatorPriceListData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach (
            $this->translator->translatorPriceLists
            as $translatorPriceList
        ) {
            array_push($this->selected, $translatorPriceList->id);
        }
    }

    public function render()
    {
        return view('livewire.translator-translator-price-lists-detail', [
            'translatorPriceLists' => $this->translator
                ->translatorPriceLists()
                ->paginate(20),
        ]);
    }
}
