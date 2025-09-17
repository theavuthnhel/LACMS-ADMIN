<?php

namespace App\Filament\Guest\Pages;

use Filament\Pages\Page;

class VideoPage extends Page
{
    protected string $view = 'filament.guest.pages.video-page';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'client/video';

    protected ?string $heading = '';

    protected static string $layout = 'components.guest.layout.index';
}
