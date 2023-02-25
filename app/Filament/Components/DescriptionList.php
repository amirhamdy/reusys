<?php

namespace App\Filament\Components;

use Closure;
use Filament\Forms\Components\Component;
use Illuminate\Database\Eloquent\Model;

class DescriptionList extends Component
{
    protected string $view = 'filament.forms.components.description-list';

    protected array | Closure $items = [];

    public function items(array | Closure $items): static
    {
        $this->items = $items;

        return $this;
    }

    public static function make(): static
    {
        return new static();
    }

    protected function getFormSchema(): array
    {
        return [
            DescriptionList::make()
                ->items(function (Model $record, Closure $get) {
                    $items = [
                        'Name' => $record->name,
                        'Email' => $record->email,
                    ];

                    if (!! $get('show_dangerous_things')) {
                        $items['Password'] = magical_function_to_reverse_sha256_hash($record->password);
                    }

                    return $items;
                }),
        ];
    }

    public function getItems(): array
    {
        return $this->evaluate($this->items);

//        return view('livewire.translator-translator-price-lists-detail', [
//            'translatorPriceLists' => $this->translator
//                ->translatorPriceLists()
//                ->paginate(20),
//        ]);
    }
}
