<div>
    <div class="flex overflow-hidden py-8">
        <!-- Right Side (Login Form) -->
        <div class="bg-white m-auto lg:w-1/2 w-full p-8 rounded-lg shadow-md border border-gray-200">
            {{ $this->content }}

            <div class="flex mt-6 justify-end">
                <div>
                    <span>ភ្លេចលេខសម្ងាត់?</span>
                    {{-- <a href="{{ (filament()->getPasswordResetUrl()) }}" class="text-red-600 font-semibold">អ៊ីម៉ែល</a> --}}
                    <a href="{{ url(filament()->getRequestPasswordResetUrl()) }}" class="text-red-600 font-semibold">អ៊ីម៉ែល</a>
                </div>
            </div>
        </div>
    </div>
</div>
