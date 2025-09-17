<?php

namespace App\Filament\Company\Pages\Auth;

use Filament\Auth\Pages\Login as PagesLogin;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Packages\FilamentTurnstile\Forms\Components\Turnstile;

class CompanyLogin extends PagesLogin
{
    protected static string $layout = 'components.guest.layout.index';

    protected string $view = 'filament.company.pages.auth.company-login';

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

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label(__('filament-panels::auth/pages/login.form.email.label'))
            ->email()
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label(__('filament-panels::auth/pages/login.form.password.label'))
            ->hint(filament()->hasPasswordReset() ? new HtmlString(Blade::render('<x-filament::link :href="filament()->getRequestPasswordResetUrl()" tabindex="3"> {{ __(\'filament-panels::auth/pages/login.actions.request_password_reset.label\') }}</x-filament::link>')) : null)
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->autocomplete('current-password')
            ->required()
            ->extraInputAttributes(['tabindex' => 2]);
    }
}
