@php
    use Filament\Support\Enums\Width;
@endphp
@vite('resources/css/app.css')
<x-filament-panels::layout.base :livewire="$livewire">
    @props([
        'after' => null,
        'heading' => null,
        'subheading' => null,
        'logo' => true,
    ])

    <div class="fi-simple-layout flex min-h-screen flex-col items-center lg:p-10">

        <div
            class="fi-simple-main-ctn flex w-full items-center justify-center"
        >
            <main
                @class([
                    'my-16 w-full bg-white border border-gray-100 rounded-lg shadow-lg',
                    match ($maxWidth ?? null) {
                        Width::ExtraSmall, 'xs' => 'sm:max-w-xs',
                        Width::Small, 'sm' => 'sm:max-w-sm',
                        Width::Medium, 'md' => 'sm:max-w-md',
                        Width::ExtraLarge, 'xl' => 'sm:max-w-xl',
                        Width::TwoExtraLarge, '2xl' => 'sm:max-w-2xl',
                        Width::ThreeExtraLarge, '3xl' => 'sm:max-w-3xl',
                        Width::FourExtraLarge, '4xl' => 'sm:max-w-4xl',
                        Width::FiveExtraLarge, '5xl' => 'sm:max-w-5xl',
                        Width::SixExtraLarge, '6xl' => 'sm:max-w-6xl',
                        Width::SevenExtraLarge, '7xl' => 'sm:max-w-7xl',
                        default => 'sm:max-w-7xl',
                    },
                ])
            >
                {{ $slot }}
            </main>
        </div>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::FOOTER, scopes: $livewire->getRenderHookScopes()) }}
    </div>
</x-filament-panels::layout.base>
