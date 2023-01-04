<?php

namespace App\Providers;

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
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label('Customers')
                    ->icon('heroicon-o-collection')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Product Lines')
                    ->icon('heroicon-o-collection')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Projects')
                    ->icon('heroicon-o-collection')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Jobs')
                    ->icon('heroicon-o-collection')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Tasks')
                    ->icon('heroicon-o-collection')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Resources')
                    ->icon('heroicon-o-collection')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Price Books')
                    ->icon('heroicon-o-collection')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Portals')
                    ->icon('heroicon-o-collection')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Opportunities')
                    ->icon('heroicon-o-collection')
                    ->collapsed(),
            ]);

//            Filament::registerPages($this->pages);
        });
    }
}
