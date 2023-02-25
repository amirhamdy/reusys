<dl>
    @foreach($this->getItems() as $term => $description)
        <dt>{{ $term }}</dt>
        <dd>{{ $description }}</dd>
    @endforeach

        <form wire:submit.prevent="submit">
            {{ $this->form }}

            <button type="submit">
                Submit
            </button>
        </form>
</dl>
