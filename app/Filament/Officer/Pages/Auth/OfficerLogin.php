<?php

namespace App\Filament\Officer\Pages\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Auth\Pages\Login as PagesLogin;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Component;
use Packages\FilamentTurnstile\Forms\Components\Turnstile;
use Filament\Auth\Http\Responses\LoginResponse;
use Filament\Auth\MultiFactor\Contracts\HasBeforeChallengeHook;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Notifications\TwoFactorCode;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class OfficerLogin extends PagesLogin
{
    protected string $view = 'filament.officer.pages.auth.officer-login';
    protected static string $layout = 'components.guest.layout.index';

    public $type = null;

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

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('អាសយដ្ឋានអ៊ីមែល')
            ->email()
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label('ពាក្យសម្ងាត់')
            // ->hint(filament()->hasPasswordReset() ? new HtmlString(Blade::render('<x-filament::link :href="filament()->getRequestPasswordResetUrl()" tabindex="3"> {{ __(\'filament-panels::auth/pages/login.actions.request_password_reset.label\') }}</x-filament::link>')) : null)
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->autocomplete('current-password')
            ->required()
            ->extraInputAttributes(['tabindex' => 2]);
    }

    protected function getCaptchaFormComponent(): Component
    {
        return Turnstile::make('captcha')
            ->theme('auto')
            ->language('en-US')
            ->size('normal');
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

        $authProvider = $authGuard->getProvider();
        /** @phpstan-ignore-line */
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
        // if($user->next_two_factor_at < now()){
        //     $user->generateTwoFactorCode();
        //     $user->notify(new TwoFactorCode());
        // }

        $redirects = [
            'inspection'                => 'https://sicms.mlvt.gov.kh/account/login/',
            'https://ot.mlvt.gov.kh'    => 'https://ot.mlvt.gov.kh/account/login/',
            'self-inspection'           => 'https://self-inspection.mlvt.gov.kh/account/login/',
            'l9sicms'                   => 'http://l9sicms.mlvt.gov.kh/account/login/',
            'l10sicms'                  => 'http://l10sicms.mlvt.gov.kh/account/login/',
            'inspection1'               => 'https://test-inspection.mlvt.gov.kh/account/login/',
            'inspection2'               => 'http://rumdoul.com/sothea/inspection_v3/account/login/',
            'inspection-app'            => 'http://sicms.mlvt.gov.kh/app/account/login/',
            'self-inspection-app'       => 'http://self-inspection.mlvt.gov.kh/app/account/login/',
            'l9sicms-app'               => 'http://l9sicms.mlvt.gov.kh/app/account/login/',
            'l10sicms-app'              => 'http://l10sicms.mlvt.gov.kh/app/account/login/',
        ];
        if (isset($redirects[$this->type])) {
            $company_id = Crypt::encrypt(Auth::user()->company->id ?? 0);

            Auth::logout();

            redirect()->away($redirects[$this->type] . $company_id);
            return null;
        }
        if (Auth::user()->is_company == 1 || Auth::user()->is_client == 1) {
            if (Auth::user()->is_admin == 1 || Auth::user()->is_ministry == 1 || Auth::user()->is_partner == 1) {
                Auth::logout();
                Notification::make()->title(__('message.error_user_type'))->warning()->send();
                redirect()->route('login');
                return null;
            }

            if (Auth::user()->active == 0) {
                Auth::logout();
                redirect()->route('client.client.manage.wait');
                return null;
            }
            if (Auth::user()->active == 2 && Auth::user()->mail_code != "") {
                $type = "";
                if (Auth::user()->is_company == 1) {
                    $type = "company";
                } else {
                    $type = "worker";
                }
                redirect()->route('client.client.company.edit.decline', ['code' => Auth::user()->mail_code, 'id' => Crypt::encrypt(Auth::user()->id), 'type' => $type]);
                return null;
            }
            if (Auth::user()->active == 3) {
                Auth::logout();
                redirect()->route('auth.void');
                return null;
            }

            if (Auth::user()->active == 9) {
                $operation_status = Auth::user()->company->operation_status;
                Auth::logout();
                redirect()->route('auth.push', ['operation_status' => Crypt::encrypt($operation_status)]);
                return null;
            }


            if (Auth::user()->active == 1) {
                if (Auth::user()->is_company == 1) {
                    if (Auth::user()->is_registered_by_admin && Auth::user()->company->is_updated == 0) {
                        redirect()->route('client.company.update.profile.edit');
                        return null;
                    }
                    redirect()->route('client/dashboard');
                    return null;
                }

                if (Auth::user()->is_client == 1)
                    redirect()->route('client/home');
                return null;
            }
        }

        if (Auth::user()->is_ministry == 1) {
            if (Auth::user()->active == 0) {
                Auth::logout();
                redirect()->route('auth.inactive');
                return null;
            }
            if (Auth::user()->is_client == 1 || Auth::user()->is_company == 1) {
                Auth::logout();
                Notification::make()->title(__('message.error_user_type'))->warning()->send();
                redirect()->route('login.admin');
                return null;
            }
            if (Auth::user()->is_admin == 1 || Auth::user()->is_ministry == 1) {
                if (Auth::user()->is_admin == 1) {
                    redirect()->route('user.user.index');
                    return null;
                } else {
                    if (Auth::user()->active == 0) {
                        Auth::logout();
                        redirect()->route('auth.inactive');
                        return null;
                    }
                    redirect()->route('dashboard');
                    return null;
                }
            }
        }

        if (Auth::user()->is_partner == 1) {
            $today = date("Y-m-d");
            $expired_date = date("Y-m-d", strtotime(Auth::user()->expired_date));
            if ($today > $expired_date) {
                Auth::logout();
                redirect()->route('auth.expired');
                return null;
            } else {
                redirect()->route('physical_partner');
                return null;
            }
        }
        session()->regenerate();

        return app(LoginResponse::class);
    }
}
