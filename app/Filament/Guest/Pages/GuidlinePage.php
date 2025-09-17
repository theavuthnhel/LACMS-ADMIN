<?php

namespace App\Filament\Guest\Pages;

use Filament\Pages\Page;

class GuidlinePage extends Page
{
    protected string $view = 'filament.guest.pages.guidline-page';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'client/guidline';

    protected ?string $heading = '';

    protected static string $layout = 'components.guest.layout.index';
}
