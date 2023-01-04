<x-filament::page>
    <dl>
        @foreach($getItems() as $term => $description)
            <dt>{{ $term }}</dt>
            <dd>{{ $description }}</dd>
        @endforeach
    </dl>
</x-filament::page>
