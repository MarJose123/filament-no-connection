<?php

namespace MarJose123\FilamentNoConnection;

use Filament\Facades\Filament;
use Filament\PluginServiceProvider;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;
use MarJose123\FilamentNoConnection\Http\Livewire\Offline;
use Spatie\LaravelPackageTools\Package;

class FilamentNoConnectionServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-no-connection';

    protected array $resources = [
        // CustomResource::class,
    ];

    protected array $pages = [
        // CustomPage::class,
    ];

    protected array $widgets = [
        // CustomWidget::class,
    ];

    protected array $styles = [
        'plugin-filament-no-connection' => __DIR__.'/../resources/dist/filament-no-connection.css',
    ];

    protected array $scripts = [
        'plugin-filament-no-connection' => __DIR__.'/../resources/dist/filament-no-connection.js',
    ];

    // protected array $beforeCoreScripts = [
    //     'plugin-filament-no-connection' => __DIR__ . '/../resources/dist/filament-no-connection.js',
    // ];

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasViews();
    }

    public function packageBooted(): void
    {
        parent::packageBooted();
        Livewire::component('Offline', Offline::class);
        Filament::registerRenderHook(
            'body.end',
            fn (): string => Blade::render('@livewire(\'Offline\')'),
        );
    }

}
