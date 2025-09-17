<?php

namespace App\Filament\Guest\Pages;

use Filament\Pages\Page;

class FaqPage extends Page
{
    protected string $view = 'filament.guest.pages.faq-page';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'client/faq';

    protected ?string $heading = '';

    protected static string $layout = 'components.guest.layout.index';
}
