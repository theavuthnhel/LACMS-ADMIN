<?php

namespace App\Filament\Guest\Pages;

use Filament\Pages\Page;

class ProkasPage extends Page
{
    protected string $view = 'filament.guest.pages.prokas-page';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'client/prokas';

    protected ?string $heading = '';

    protected static string $layout = 'components.guest.layout.index';
}
