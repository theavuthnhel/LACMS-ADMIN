<?php

namespace App\Filament\Officer\Pages\Auth;

use Filament\Auth\Pages\Login as PagesLogin;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Packages\FilamentTurnstile\Forms\Components\Turnstile;

class OfficerLogin extends PagesLogin
{
    protected string $view = 'filament.officer.pages.auth.officer-login';

    protected static string $layout = 'components.guest.layout.index';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                // app()->environment() != 'local' ? $this->getCaptchaFormComponent() : null,
                $this->getRememberFormComponent(),
            ]);
    }

    protected function getCaptchaFormComponent(): Component
    {
        return Turnstile::make('captcha')
            ->theme('auto') // accepts light, dark, auto
            ->language('en-US') // see below
            ->size('normal'); // accepts normal, compact
    }
}
