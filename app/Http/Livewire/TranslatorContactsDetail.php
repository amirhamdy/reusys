<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;
use App\Models\Translator;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TranslatorContactsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Translator $translator;
    public Contact $contact;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Contact';

    protected $rules = [
        'contact.name' => ['required', 'max:255', 'string'],
        'contact.phone' => ['required', 'max:255', 'string'],
        'contact.email' => ['required', 'email'],
        'contact.position' => ['nullable', 'max:255', 'string'],
    ];

    public function mount(Translator $translator)
    {
        $this->translator = $translator;
        $this->resetContactData();
    }

    public function resetContactData()
    {
        $this->contact = new Contact();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newContact()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.translator_contacts.new_title');
        $this->resetContactData();

        $this->showModal();
    }

    public function editContact(Contact $contact)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.translator_contacts.edit_title');
        $this->contact = $contact;

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

        if (!$this->contact->translator_id) {
            $this->authorize('create', Contact::class);

            $this->contact->translator_id = $this->translator->id;
        } else {
            $this->authorize('update', $this->contact);
        }

        $this->contact->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Contact::class);

        Contact::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetContactData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->translator->contacts as $contact) {
            array_push($this->selected, $contact->id);
        }
    }

    public function render()
    {
        return view('livewire.translator-contacts-detail', [
            'contacts' => $this->translator->contacts()->paginate(20),
        ]);
    }
}
