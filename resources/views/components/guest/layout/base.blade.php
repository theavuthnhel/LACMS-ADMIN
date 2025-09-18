@props([
    'livewire' => null,
])

@php
    $renderHookScopes = $livewire?->getRenderHookScopes();
@endphp

<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}"
    @class([
        'fi',
        'light'
    ])
>
    <head>
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::HEAD_START, scopes: $renderHookScopes) }}

        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        @if ($favicon = filament()->getFavicon())
            <link rel="icon" href="{{ $favicon }}" />
        @endif

        @php
            $title = trim(strip_tags($livewire?->getTitle() ?? ''));
            $brandName = trim(strip_tags(filament()->getBrandName()));
        @endphp

        <title>
            {{ filled($title) ? "{$title} - " : null }} {{ $brandName }}
        </title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::STYLES_BEFORE, scopes: $renderHookScopes) }}

        <style>
            [x-cloak=''],
            [x-cloak='x-cloak'],
            [x-cloak='1'] {
                display: none !important;
            }

            [x-cloak='inline-flex'] {
                display: inline-flex !important;
            }

            @media (max-width: 1023px) {
                [x-cloak='-lg'] {
                    display: none !important;
                }
            }

            @media (min-width: 1024px) {
                [x-cloak='lg'] {
                    display: none !important;
                }
            }
        </style>

        @filamentStyles

        {{ filament()->getTheme()->getHtml() }}
        {{ filament()->getFontHtml() }}
        {{ filament()->getMonoFontHtml() }}
        {{ filament()->getSerifFontHtml() }}

        <style>
            :root {
                --font-family: '{!! filament()->getFontFamily() !!}';
                --mono-font-family: '{!! filament()->getMonoFontFamily() !!}';
                --serif-font-family: '{!! filament()->getSerifFontFamily() !!}';
                /* --sidebar-width: {{ filament()->getSidebarWidth() }}; */
                /* --collapsed-sidebar-width: {{ filament()->getCollapsedSidebarWidth() }}; */
                /* --default-theme-mode: {{ filament()->getDefaultThemeMode()->value }}; */
            }
        </style>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::STYLES_AFTER, scopes: $renderHookScopes) }}
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::HEAD_END, scopes: $renderHookScopes) }}
        
        <style>
            body {
                font-family: 'Kantumruy Pro', sans-serif;
            }

            .fi-input {
                /* border-width: 1px; */
                /* border-style: solid; */
                /* border-color: #e5e7eb; */
                padding: 0.6rem;
            }
            .fi-input-wrp {
                border-width: 1px;
                border-style: solid;
                border-color: #e5e7eb;
            }

            input[type='checkbox'].fi-checkbox-input {
                width: calc(var(--spacing) * 4);
                height: calc(var(--spacing) * 4);
                appearance: none;
                border-radius: 0.25rem;
                --tw-border-style: none;
                border-style: none;
                background-color: var(--color-white);
                vertical-align: middle;
                color: var(--primary-600);
                --tw-shadow: 0 1px 3px 0 var(--tw-shadow-color, rgb(0 0 0 / 0.1)), 0 1px 2px -1px var(--tw-shadow-color, rgb(0 0 0 / 0.1));
                --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color, currentcolor);
                box-shadow: var(--tw-inset-shadow), var(--tw-inset-ring-shadow), var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow);
                --tw-ring-color: 
                color-mix(in oklab, var(--gray-950) 10%, transparent);
            }

            /* .fi-color-primary {
                --color-50: var(--primary-50);
                --color-100: var(--primary-100);
                --color-200: var(--primary-200);
                --color-300: var(--primary-300);
                --color-400: var(--primary-400);
                --color-500: var(--primary-500);
                --color-600: var(--primary-600);
                --color-700: var(--primary-700);
                --color-800: var(--primary-800);
                --color-900: var(--primary-900);
                --color-950: var(--primary-950);
            } */

            .fi-btn {
                position: relative;
                display: inline-grid;
                grid-auto-flow: column;
                align-items: center;
                justify-content: center;
                gap: calc(var(--spacing) * 1.5);
                border-radius: var(--radius-lg);
                padding-inline: calc(var(--spacing) * 3);
                padding-block: calc(var(--spacing) * 3);
                font-size: var(--text-md);
                line-height: var(--tw-leading, var(--text-sm--line-height));
                --tw-font-weight: var(--font-weight-semibold);
                font-weight: var(--font-weight-semibold);
                transition-property: color, background-color, border-color, outline-color, text-decoration-color, fill, stroke, --tw-gradient-from, --tw-gradient-via, --tw-gradient-to, opacity, box-shadow, transform, translate, scale, rotate, filter, -webkit-backdrop-filter, backdrop-filter, display, content-visibility, overlay, pointer-events;
                transition-timing-function: var(--tw-ease, var(--default-transition-timing-function));
                transition-duration: var(--tw-duration, var(--default-transition-duration));
                --tw-duration: 75ms;
                transition-duration: 75ms;
                --tw-outline-style: none;
                outline-style: none;
                background-color: rgba(59,130,246,var(--tw-bg-opacity));
                color: white;
            }

            .shine-effect {
                position: relative;
                overflow: hidden;
            }
            .shine-effect::after {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 20%;
                height: 200%;
                background: rgba(255, 255, 255, 0.4);
                transform: rotate(45deg);
                animation: shine 2s infinite;
            }
            @keyframes shine {
                0% {
                    left: -50%;
                }
                100% {
                    left: 150%;
                }
            }
        </style>
    </head>

    <body
        {{
            $attributes
                ->merge($livewire?->getExtraBodyAttributes() ?? [], escape: false)
                ->class([
                    'fi-body',
                    'fi-panel-' . filament()->getId(),
                ])
        }}
    >
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::BODY_START, scopes: $renderHookScopes) }}
        
        <header class="bg-white shadow-sm">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-start py-2">

                    <div class="flex items-center">
                        <img alt="Ministry of Labour and Vocational Training logo" class="h-36 w-auto" src="https://lacms.mlvt.gov.kh/backend/img/mlvt_banner_logo_1.jpg"/>
                        <!-- <div class="ml-4">
                            <h1 class="text-xl font-bold text-blue-800">ក្រសួងការងារ និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ</h1>
                            <p class="text-sm text-gray-600">Ministry of Labour and Vocational Training</p>
                        </div> -->
                    </div>

                    <div class="flex items-center space-x-4">
                        <button class="flex items-center space-x-1 text-gray-700 rounded-full py-2 px-4 bg-blue-600 text-gray-700 hover:text-white hover:border-0">
                            <img alt="Cambodian flag" class="w-6 h-4" src="https://lacms.mlvt.gov.kh/backend/img/km.png"/>
                            <span class="text-white">ភាសាខ្មែរ</span>
                        </button>
                        <button class="flex items-center space-x-1 border rounded-full py-2 px-4 hover:bg-blue-600 text-gray-700 hover:text-white hover:border-0">
                            <img alt="British flag" class="w-6 h-4" src="https://lacms.mlvt.gov.kh/backend/img/en_new.png"/>
                            <span class="">English</span>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <nav class="bg-blue-500">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-center h-16">
                    <div class="hidden md:flex items-center space-x-4">
                        <a class="text-white px-3 py-2 font-semibold rounded-full text-md font-medium hover:bg-blue-600 {{ request()->routeIs('filament.guest.pages..') ? 'bg-blue-600 rounded-full' : '' }}" href="{{ route('filament.guest.pages..') }}">
                            <span class="material-icons align-middle text-base">home</span>
                            <span>ទំព័រដើម</span>
                        </a>
                        <a class="text-white px-3 py-2 font-semibold rounded-full text-md font-medium hover:bg-blue-600 {{ request()->routeIs('filament.guest.pages.client.guidline') ? 'bg-blue-600 rounded-full' : '' }}" href="{{ route('filament.guest.pages.client.guidline') }}">សៀវភៅណែនាំ</a>
                        <a class="text-white px-3 py-2 font-semibold rounded-full text-md font-medium hover:bg-blue-600 {{ request()->routeIs('filament.guest.pages.client.prokas') ? 'bg-blue-600 rounded-full' : '' }}" href="{{ route('filament.guest.pages.client.prokas') }}">លិខិតបទដ្ឋាន</a>
                        <a class="text-white px-3 py-2 font-semibold rounded-full text-md font-medium hover:bg-blue-600 {{ request()->routeIs('filament.guest.pages.client.close.document') ? 'bg-blue-600 rounded-full' : '' }}" href="{{ route('filament.guest.pages.client.close.document') }}">លិខិតធ្វើបច្ចុប្បន្នភាពនិងបិទសហគ្រាស</a>
                        <a class="text-white px-3 py-2 font-semibold rounded-full text-md font-medium hover:bg-blue-600 {{ request()->routeIs('filament.guest.pages.client.faq') ? 'bg-blue-600 rounded-full' : '' }}" href="{{ route('filament.guest.pages.client.faq') }}">សំនួរ និងចម្លើយ</a>
                        <a class="text-white px-3 py-2 font-semibold rounded-full text-md font-medium hover:bg-blue-600 {{ request()->routeIs('filament.guest.pages.client.video') ? 'bg-blue-600 rounded-full' : '' }}" href="{{ route('filament.guest.pages.client.video') }}">វីដេអូនៃការប្រើប្រាស់</a>
                        <a class="text-white px-3 py-2 font-semibold rounded-full text-md font-medium hover:bg-blue-600 {{ request()->routeIs('filament.officer.auth.login') ? 'bg-blue-600 rounded-full' : '' }}" href="{{ route('filament.officer.auth.login') }}"><span class="material-icons align-middle text-base">lock</span> ចូលជាមន្ត្រីត្រួតពិនិត្យ</a>
                    </div>
                    <div class="md:hidden">
                        <button class="text-white focus:outline-none">
                            <span class="material-icons">menu</span>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{ $slot }}
        </main>

        <footer class="bg-gray-100 py-4 border-t border-gray-200 w-full bottom-0">
            <div class="flex flex-row justify-between items-center mx-auto px-4 sm:px-6 lg:px-8">
                <div>
                    © ២០២៥ រក្សាសិទ្ធិគ្រប់យ៉ាងដោយ <a href="http://mlvt.gov.kh" class="text-blue-600" target="_blank">ក្រសួងការងារ និងបណ្តុះបណ្ដាលវិជ្ជាជីវៈនៃព្រះរាជាណាចក្រកម្ពុជា</a>
                </div>
                <div class="pull-right hidden-xs">
                    <b>ជំនាន់</b> 3.0.0
                </div>
            </div>
        </footer>

        @livewire(Filament\Livewire\Notifications::class)

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SCRIPTS_BEFORE, scopes: $renderHookScopes) }}

        @filamentScripts(withCore: true)

        @if (filament()->hasBroadcasting() && config('filament.broadcasting.echo'))
            <script data-navigate-once>
                window.Echo = new window.EchoFactory(@js(config('filament.broadcasting.echo')))

                window.dispatchEvent(new CustomEvent('EchoLoaded'))
            </script>
        @endif

        @stack('scripts')

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SCRIPTS_AFTER, scopes: $renderHookScopes) }}

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::BODY_END, scopes: $renderHookScopes) }}
    </body>
</html>
