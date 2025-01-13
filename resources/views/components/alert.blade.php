@if (session()->exists('alerts'))
    @foreach (session('alerts') as $alert)
        @switch($alert['level'])
            @case('success')
                <div class="flex items-center p-4 mb-4 rounded-lg bg-gray-800 text-green-400" id="alert-2" role="alert"
                    x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition:leave.duration.1000ms>
                    <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {!! $alert['message'] !!}
                    </div>
                    <button @click="show=false" aria-label="Close"
                        class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 inline-flex items-center justify-center h-8 w-8 bg-gray-800 text-green-400 hover:bg-gray-700"
                        data-dismiss-target="#alert-2" type="button">
                        <span class="sr-only">Close</span>
                        <svg aria-hidden="true" class="w-3 h-3" fill="none" viewBox="0 0 14 14"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" stroke="currentColor" />
                        </svg>
                    </button>
                </div>
            @break

            @case('error')
                <div class="flex items-center p-4 mb-4 rounded-lg bg-gray-800 text-red-400" id="alert-2" role="alert"
                    x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition:leave.duration.1000ms>
                    <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {!! $alert['message'] !!}
                    </div>
                    <button @click="show=false" aria-label="Close"
                        class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 inline-flex items-center justify-center h-8 w-8 bg-gray-800 text-red-400 hover:bg-gray-700"
                        data-dismiss-target="#alert-2" type="button">
                        <span class="sr-only">Close</span>
                        <svg aria-hidden="true" class="w-3 h-3" fill="none" viewBox="0 0 14 14"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" stroke="currentColor" />
                        </svg>
                    </button>
                </div>
            @break

            @case('warning')
                <div class="flex items-center p-4 mb-4 rounded-lg bg-gray-800 text-yellow-400" id="alert-2" role="alert"
                    x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition:leave.duration.1000ms>
                    <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {!! $alert['message'] !!}
                    </div>
                    <button @click="show=false" aria-label="Close"
                        class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 inline-flex items-center justify-center h-8 w-8 bg-gray-800 text-yellow-400 hover:bg-gray-700"
                        data-dismiss-target="#alert-2" type="button">
                        <span class="sr-only">Close</span>
                        <svg aria-hidden="true" class="w-3 h-3" fill="none" viewBox="0 0 14 14"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" stroke="currentColor" />
                        </svg>
                    </button>
                </div>
            @break

            @default
                <div class="flex items-center p-4 mb-4 rounded-lg bg-gray-800 text-blue-400" id="alert-2" role="alert"
                    x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition:leave.duration.1000ms>
                    <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {!! $alert['message'] !!}
                    </div>
                    <button @click="show=false" aria-label="Close"
                        class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 inline-flex items-center justify-center h-8 w-8 bg-gray-800 text-blue-400 hover:bg-gray-700"
                        data-dismiss-target="#alert-2" type="button">
                        <span class="sr-only">Close</span>
                        <svg aria-hidden="true" class="w-3 h-3" fill="none" viewBox="0 0 14 14"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" stroke="currentColor" />
                        </svg>
                    </button>
                </div>
        @endswitch

        {{-- <div {{ $attributes->merge(['class' => "w-screen max-w-lg $bg_color mx-auto mt-6 p-2"]) }} role="alert"
            x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition:leave.duration.800ms>
            <a @click="show=false" href="{{ $alert['href'] }}">
                <div class="flex space-x-2 cursor-pointer">
                    <svg class="w-6 h-6 {{ $stroke_color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        </path>
                    </svg>
                    <p class="font-semibold {{ $text_color }}">{{ $alert['message'] }}</p>
                </div>
            </a>
        </div> --}}
    @endforeach
@endif
