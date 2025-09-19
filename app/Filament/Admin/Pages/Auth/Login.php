<?php

namespace App\Filament\Admin\Pages\Auth;

use BackedEnum;
use Filament\Auth\Pages\Login as PagesLogin;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Packages\FilamentTurnstile\Forms\Components\Turnstile;

class Login extends PagesLogin
{
    protected static string | BackedEnum | null $navigationIcon = null;

    protected Width | string | null $maxWidth = '4xl';

    protected static string $layout = 'components.layout.auth';

    /**
     * @var view-string
     */
    protected string $view = 'filament.pages.auth.login';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                app()->environment() != 'local' && $this->getCaptchaFormComponent(),
                $this->getRememberFormComponent(),
                $this->getSelectionTest(),
            ]);
    }

    protected function getCaptchaFormComponent(): Component
    {
        return Turnstile::make('captcha')
            ->theme('auto') // accepts light, dark, auto
            ->language('en-US') // see below
            ->size('normal'); // accepts normal, compact
    }

    protected function getSelectionTest(): Component
    {
        return Select::make("test")
            ->options([1 => "est"])
            ->searchable()
            ->required();
    }
}
