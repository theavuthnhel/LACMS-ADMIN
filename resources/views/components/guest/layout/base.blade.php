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
                --sidebar-width: {{ filament()->getSidebarWidth() }};
                --collapsed-sidebar-width: {{ filament()->getCollapsedSidebarWidth() }};
                --default-theme-mode: {{ filament()->getDefaultThemeMode()->value }};
            }
        </style>

        @stack('styles')

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::STYLES_AFTER, scopes: $renderHookScopes) }}
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::HEAD_END, scopes: $renderHookScopes) }}
        
        <style>
            body {
                font-family: 'Kantumruy Pro', sans-serif;
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
                <div class="flex justify-between items-center py-4">

                    <div class="flex items-center">
                        <img alt="Ministry of Labour and Vocational Training logo" class="h-36 w-auto" src="https://lacms.mlvt.gov.kh/backend/img/mlvt_banner_logo_1.jpg"/>
                        <!-- <div class="ml-4">
                            <h1 class="text-xl font-bold text-blue-800">ក្រសួងការងារ និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ</h1>
                            <p class="text-sm text-gray-600">Ministry of Labour and Vocational Training</p>
                        </div> -->
                    </div>

                    <div class="flex items-center space-x-4">
                        <button class="flex items-center space-x-1 text-gray-700">
                            <img alt="Cambodian flag" class="w-6 h-4" src="https://lacms.mlvt.gov.kh/backend/img/km.png"/>
                            <span>ភាសាខ្មែរ</span>
                        </button>
                        <button class="flex items-center space-x-1 text-gray-700">
                            <img alt="British flag" class="w-6 h-4" src="https://lacms.mlvt.gov.kh/backend/img/en_new.png"/>
                            <span>English</span>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <nav class="bg-blue-500">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-center h-16">
                    <div class="hidden md:flex items-center space-x-4">
                        <a class="text-white px-3 py-2 font-semibold rounded-md text-md font-medium hover:bg-blue-600" href="{{ route('filament.guest.pages..') }}">
                            <span class="material-icons align-middle text-base">home</span>
                            <span>ទំព័រដើម</span>
                        </a>
                        <a class="text-white px-3 py-2 font-semibold rounded-md text-md font-medium hover:bg-blue-600" href="{{ route('filament.guest.pages.client.guidline') }}">សៀវភៅណែនាំ</a>
                        <a class="text-white px-3 py-2 font-semibold rounded-md text-md font-medium hover:bg-blue-600" href="{{ route('filament.guest.pages.client.prokas') }}">លិខិតបទដ្ឋាន</a>
                        <a class="text-white px-3 py-2 font-semibold rounded-md text-md font-medium hover:bg-blue-600" href="{{ route('filament.guest.pages.client.close.document') }}">លិខិតធ្វើបច្ចុប្បន្នភាពនិងបិទសហគ្រាស</a>
                        <a class="text-white px-3 py-2 font-semibold rounded-md text-md font-medium hover:bg-blue-600" href="{{ route('filament.guest.pages.client.faq') }}">សំនួរ និងចម្លើយ</a>
                        <a class="text-white px-3 py-2 font-semibold rounded-md text-md font-medium hover:bg-blue-600" href="{{ route('filament.guest.pages.client.video') }}">វីដេអូនៃការប្រើប្រាស់</a>
                        <a class="text-white px-3 py-2 font-semibold rounded-md text-md font-medium hover:bg-blue-600" href="#"><span class="material-icons align-middle text-base">lock</span> ចូលជាមន្ត្រីត្រួតពិនិត្យ</a>
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

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <section class="text-center mt-12">
            <h2 class="text-2xl font-bold text-blue-800">សម្រាប់ព័ត៌មានបន្ថែមក្នុងការប្រើប្រាស់សេវាស្វ័យប្រវត្តិកម្ម សូមទំនាក់ទំនងតាមរយៈ ៖</h2>
        </section>

        <section class="mt-8 py-8">
            <div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-8 text-center md:text-left">
                    <div class="bg-white p-4 rounded-lg shadow-sm flex flex-col justify-center items-center shadow-md">
                        <a class="bg-blue-100 p-4 rounded-full text-blue-600 hover:bg-blue-200 transition duration-300" href="https://lacms.mlvt.gov.kh/request_lot/create?request_type=2">
                            <span class="material-icons text-4xl">phone</span>
                        </a>
                        <p class="text-sm mt-2 text-red-600">១២៩៧</p>
                        <p class="text-sm text-gray-500">២៤ ម៉ោង/៧</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm flex flex-col justify-center items-center shadow-md">
                        <a class="bg-blue-100 p-4 rounded-full text-blue-600 hover:bg-blue-200 transition duration-300" href="#">
                            <span class="material-icons text-4xl">send</span>
                        </a>
                        <p class="text-sm mt-2 text-gray-600">តេឡេក្រាម</p>
                        <p class="text-sm text-teal-600">- សម្រាប់ និយោជក</p>
                        <p class="text-sm text-teal-600">- សម្រាប់ កម្មករនិយោជិត</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm flex flex-col justify-center items-center shadow-md">
                        <a class="bg-blue-100 p-4 rounded-full text-blue-600 hover:bg-blue-200 transition duration-300" href="#">
                            <span class="material-icons text-4xl">email</span>
                        </a>
                        <p class="text-sm mt-2 text-gray-600">អុីម៉ែល</p>
                        <p class="text-sm text-gray-600">support.services@mlvt.gov.kh</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm flex flex-col justify-center items-center shadow-md">
                        <a class="bg-blue-100 p-4 rounded-full text-blue-600 hover:bg-blue-200 transition duration-300" href="#">
                            <svg aria-hidden="true" class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path clip-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" fill-rule="evenodd"></path></svg>
                        </a>
                        <p class="text-sm mt-2 text-blue-600">ក្រសួងការងារ និងបណ្ដុះបណ្ដាលវិជ្ជាជីវៈ</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm flex flex-col justify-center items-center shadow-md">
                        <a class="bg-blue-100 p-4 rounded-full text-blue-600 hover:bg-blue-200 transition duration-300" href="#">
                            <span class="material-icons text-4xl">public</span>
                        </a>
                        <!-- <p class="text-sm mt-2 text-gray-600">គេហទំព័រ</p> -->
                        <p class="text-sm text-gray-500">www.mlvt.gov.kh</p>
                    </div>
                </div>
            </div>
        </section>

        </div>

        <footer class="bg-white mt-8 py-8 border-t w-full bottom-0">
            <div class="flex flex-row justify-between items-center mx-auto px-4 sm:px-6 lg:px-8">
                <div>
                    © ២០២៣ រក្សាសិទ្ធិគ្រប់យ៉ាងដោយ <a href="http://mlvt.gov.kh" target="_blank">ក្រសួងការងារ និងបណ្តុះបណ្ដាលវិជ្ជាជីវៈនៃព្រះរាជាណាចក្រកម្ពុជា</a>
                </div>
                <div class="pull-right hidden-xs">
                    <b>ជំនាន់</b> 2.0.0
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

        @if (filament()->hasDarkMode() && (! filament()->hasDarkModeForced()))
            <script>
                loadDarkMode()
            </script>
        @endif

        @stack('scripts')

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SCRIPTS_AFTER, scopes: $renderHookScopes) }}

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::BODY_END, scopes: $renderHookScopes) }}
    </body>
</html>
