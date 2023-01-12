<?php

namespace App\Providers;

use App\Filament\Pages\FindTranslators;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $pages = [
//        FindTranslators::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::serving(function () {
//            Filament::registerViteTheme('resources/css/filament.css');

            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label('Customers')
                    ->icon('heroicon-o-collection')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Product Lines')
                    ->icon('heroicon-o-menu')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Projects')
                    ->icon('heroicon-o-presentation-chart-bar')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Jobs')
                    ->icon('heroicon-o-newspaper')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Tasks')
                    ->icon('heroicon-o-calculator')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Resources')
                    ->icon('heroicon-o-database')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Price Books')
                    ->icon('heroicon-o-book-open')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Portals')
                    ->icon('heroicon-o-key')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Opportunities')
                    ->icon('heroicon-o-mail-open')
                    ->collapsed(),
            ]);

//            Filament::registerPages($this->pages);
        });
    }
}
