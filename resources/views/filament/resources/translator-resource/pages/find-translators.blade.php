{{--<x-filament::page>--}}
{{--    <livewire:description-list />--}}

{{--    <form wire:submit.prevent="submit">--}}
{{--        {{ $this->form }}--}}

{{--        <br>--}}
{{--        <button type="submit">--}}
{{--            Submit--}}
{{--        </button>--}}
{{--    </form>--}}
{{--</x-filament::page>--}}

<x-filament::page
    :class="\Illuminate\Support\Arr::toCssClasses([
        'filament-resources-list-records-page',
        'filament-resources-' . str_replace('/', '-', $this->getResource()::getSlug()),
    ])"
>
        <form wire:submit.prevent="submit">
            {{ $this->form }}

            <br>
            <button type="submit">
                Find Resources
            </button>
        </form>

    {{ $this->table }}
</x-filament::page>
