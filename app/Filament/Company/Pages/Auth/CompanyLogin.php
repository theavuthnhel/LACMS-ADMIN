<?php

namespace App\Filament\Company\Pages\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Actions\Action;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\MultiFactor\Contracts\HasBeforeChallengeHook;
use Filament\Auth\Pages\Login as PagesLogin;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Models\Contracts\FilamentUser;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Packages\FilamentTurnstile\Forms\Components\Turnstile;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

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
            ->label("អ៊ីម៉ែល")
            ->email()
            ->prefixIcon(Heroicon::Envelope)
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label("លេខសម្ងាត់")
            ->prefixIcon(Heroicon::LockClosed)
            // ->hint(filament()->hasPasswordReset() ? new HtmlString(Blade::render('<x-filament::link :href="filament()->getRequestPasswordResetUrl()" tabindex="3"> {{ __(\'filament-panels::auth/pages/login.actions.request_password_reset.label\') }}</x-filament::link>')) : null)
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->autocomplete('current-password')
            ->required()
            ->extraInputAttributes(['tabindex' => 2]);
    }

    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $data = $this->form->getState();

        /** @var SessionGuard $authGuard */
        $authGuard = Filament::auth();

        $authProvider = $authGuard->getProvider(); /** @phpstan-ignore-line */
        $credentials = $this->getCredentialsFromFormData($data);

        $user = $authProvider->retrieveByCredentials($credentials);

        if ((! $user) || (! $authProvider->validateCredentials($user, $credentials))) {
            $this->userUndertakingMultiFactorAuthentication = null;

            $this->fireFailedEvent($authGuard, $user, $credentials);
            $this->throwFailureValidationException();
        }

        if (
            filled($this->userUndertakingMultiFactorAuthentication) &&
            (decrypt($this->userUndertakingMultiFactorAuthentication) === $user->getAuthIdentifier())
        ) {
            $this->multiFactorChallengeForm->validate();
        } else {
            foreach (Filament::getMultiFactorAuthenticationProviders() as $multiFactorAuthenticationProvider) {
                if (! $multiFactorAuthenticationProvider->isEnabled($user)) {
                    continue;
                }

                $this->userUndertakingMultiFactorAuthentication = encrypt($user->getAuthIdentifier());

                if ($multiFactorAuthenticationProvider instanceof HasBeforeChallengeHook) {
                    $multiFactorAuthenticationProvider->beforeChallenge($user);
                }

                break;
            }

            if (filled($this->userUndertakingMultiFactorAuthentication)) {
                $this->multiFactorChallengeForm->fill();

                return null;
            }
        }

        if (! $authGuard->attemptWhen($credentials, function (Authenticatable $user): bool {
            if (! ($user instanceof FilamentUser)) {
                return true;
            }

            return $user->canAccessPanel(Filament::getCurrentOrDefaultPanel());
        }, $data['remember'] ?? false)) {
            $this->fireFailedEvent($authGuard, $user, $credentials);
            $this->throwFailureValidationException();
        }

        session()->regenerate();

        // CALL YOUR CUSTOM AUTHENTICATED METHOD HERE
        // Two-factor check
        // if ($user->next_two_factor_at < now()) {
        //     Log::info('Generating two-factor code');
        //     $user->generateTwoFactorCode();
        //     $user->notify(new TwoFactorCode());
        //     Log::info('Two-factor code sent');
        // }

        // Type-based redirects
        $type = request()->get('type');

        // Inspection redirects
        if ($type == 'inspection') {
            $company_id = Crypt::encrypt($user->company->id);
            Auth::logout();
            redirect()->away('https://sicms.mlvt.gov.kh/account/login/' . $company_id);
            return null;
        }

        if ($type == 'https://ot.mlvt.gov.kh') {
            $company_id = Crypt::encrypt($user->company->id);
            Auth::logout();
            redirect()->away('https://ot.mlvt.gov.kh/account/login/' . $company_id);
            return null;
        }

        if ($type == 'self-inspection') {
            $company_id = Crypt::encrypt($user->company->id);
            Auth::logout();
            redirect()->away('https://self-inspection.mlvt.gov.kh/account/login/' . $company_id);
            return null;
        }

        if ($type == 'l9sicms') {
            $company_id = Crypt::encrypt($user->company->id);
            Auth::logout();
            redirect()->away('http://l9sicms.mlvt.gov.kh/account/login/' . $company_id);
            return null;
        }

        if ($type == 'l10sicms') {
            $company_id = Crypt::encrypt($user->company->id);
            Auth::logout();
            redirect()->away('http://l10sicms.mlvt.gov.kh/account/login/' . $company_id);
            return null;
        }

        if ($type == 'inspection1') {
            $company_id = Crypt::encrypt($user->company->id);
            Auth::logout();
            redirect()->away('https://test-inspection.mlvt.gov.kh/account/login/' . $company_id);
            return null;
        }

        if ($type == 'inspection2') {
            $company_id = Crypt::encrypt($user->company->id);
            Auth::logout();
            redirect()->away('http://rumdoul.com/sothea/inspection_v3/account/login/' . $company_id);
            return null;
        }

        if ($type == 'inspection-app') {
            $company_id = Crypt::encrypt($user->company->id);
            Auth::logout();
            redirect()->away('http://sicms.mlvt.gov.kh/app/account/login/' . $company_id);
            return null;
        }

        if ($type == 'self-inspection-app') {
            $company_id = Crypt::encrypt($user->company->id);
            Auth::logout();
            redirect()->away('http://self-inspection.mlvt.gov.kh/app/account/login/' . $company_id);
            return null;
        }

        if ($type == 'l9sicms-app') {
            $company_id = Crypt::encrypt($user->company->id);
            Auth::logout();
            redirect()->away('http://l9sicms.mlvt.gov.kh/app/account/login/' . $company_id);
            return null;
        }

        if ($type == 'l10sicms-app') {
            $company_id = Crypt::encrypt($user->company->id);
            Auth::logout();
            redirect()->away('http://l10sicms.mlvt.gov.kh/app/account/login/' . $company_id);
            return null;
        }

        // Company/Client logic
        if ($user->is_company == 1 || $user->is_client == 1) {
            if ($user->is_admin == 1 || $user->is_ministry == 1 || $user->is_partner == 1) {
                Auth::logout();
                Notification::make()
                    ->warning()
                    ->title('ចូលប្រព័ន្ធ ខុសប្រភេទសមាជិក')
                    ;
                redirect()->route('filament.admin.auth.login');
                return null;
            }

            if ($user->active == 0) {
                Auth::logout();
                redirect(route('client.client.manage.wait'));
                return null;
            }

            if ($user->active == 2 && $user->mail_code != "") {
                $type = $user->is_company == 1 ? "company" : "worker";
                redirect(route('client.client.company.edit.decline', [
                    'code' => $user->mail_code,
                    'id' => Crypt::encrypt($user->id),
                    'type' => $type
                ]));
                return null;
            }

            if ($user->active == 3) {
                Auth::logout();
                redirect(route('auth.void'));
                return null;
            }

            if ($user->active == 9) {
                $operation_status = $user->company->operation_status;
                Auth::logout();
                redirect(route('auth.push', [
                    'operation_status' => Crypt::encrypt($operation_status)
                ]));
                return null;
            }

            if ($user->active == 1) {
                if ($user->is_company == 1) {
                    if ($user->is_registered_by_admin && $user->company->is_updated == 0) {
                        redirect()->route('client.company.update.profile.edit');
                        return null;
                    }
                    redirect()->intended('company');
                    return null;
                }

                if ($user->is_client == 1) {
                    redirect()->intended('client/home');
                    return null;
                }
            }
        }

        // Ministry logic
        if ($user->is_ministry == 1) {
            if ($user->active == 0) {
                Auth::logout();
                redirect(route('auth.inactive'));
                return null;
            }

            if ($user->is_client == 1 || $user->is_company == 1) {
                Auth::logout();
                Notification::make()
                    ->warning()
                    ->title('ចូលប្រព័ន្ធ ខុសប្រភេទសមាជិក')
                    ->send();
                redirect()->route('filament.admin.auth.login');
                return null;
            }

            if ($user->is_admin == 1) {
                redirect(route('user.user.index'));
                return null;
            } else {
                redirect('dashboard');
                return null;
            }
        }

        // Partner logic
        if ($user->is_partner == 1) {
            $today = date("Y-m-d");
            $expired_date = date("Y-m-d", strtotime($user->expired_date));

            if ($today > $expired_date) {
                Auth::logout();
                redirect(route('auth.expired'));
                return null;
            } else {
                redirect('physical_partner');
                return null;
            }
        }
        
        return app(LoginResponse::class);
    }

    public function registerAction(): Action
    {
        return Action::make('register')
            ->link()
            ->label("ចុះឈ្មោះថ្មី")
            ->extraAttributes([
                'style' => 'color: blue;'
            ])
            ->url(route('filament.guest.pages.company-register'));
    }

    protected function getAuthenticateFormAction(): Action
    {
        return Action::make('authenticate')
            ->label("ចូលប្រព័ន្ធ")
            ->submit('authenticate');
    }
}
