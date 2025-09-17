<?php

namespace App\Filament\Guest\Pages;

use Filament\Pages\Page;

class DocumentPage extends Page
{
    protected string $view = 'filament.guest.pages.document-page';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'client/close/document';

    protected ?string $heading = '';

    protected static string $layout = 'components.guest.layout.index';
}
