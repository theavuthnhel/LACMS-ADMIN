<?php

namespace App\Filament\Guest\Pages;

use Filament\Pages\Page;

class HomePage extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = '/';

    protected ?string $heading = '';

    protected string $view = 'filament.guest.pages.home-page';

    protected static string $layout = 'components.guest.layout.index';
}
