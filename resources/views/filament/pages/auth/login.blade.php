<filament.page.auth>
    <div class="flex items-center justify-center">
        <div class="flex overflow-hidden w-full">
            <div class="hidden md:block lg:w-1/2 bg-cover bg-center bg-blue-700" style="background-image: url({{ asset('assets/images/login.jpg') }});">
            </div>

            <!-- Right Side (Login Form) -->
            <div class="lg:w-1/2 p-8">

                <div class="flex flex-col items-center">
                    <x-filament-panels::logo class="mb-6" />
                </div>

                @if (filament()->hasRegistration())
                    <x-slot name="subheading">
                        {{ __('filament-panels::pages/auth/login.actions.register.before') }}

                        {{ $this->registerAction }}
                    </x-slot>
                @endif

                <div class="flex flex-col items-center mb-4">
                    <div class="space-y-2 text-center">
                        <h1 class="text-xl font-medium">{{ __("Welcome back!") }}</h1>
                        <p class="text-muted-foreground text-center text-sm text-gray-500 dark:text-gray-400">{{ __("Enter your email and password below to log in") }}</p>
                    </div>
                </div>

                {{ $this->content }}

            </div>
        </div>
    </div>
</filament.page.auth>
