<div class="flex justify-between items-center mb-2">
    @if (isset($learnRoute))
        <a class="flex text-xs md:text-sm items-center text-blue-600 underline" href="{{ $learnRoute }}">Learn
            More
            <svg class="w-4 h-4 ml-2" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    @else
        <div class=""></div>
    @endif
    @if (isset($buttonRoute))
        <a href="{{ $buttonRoute }}">
            <button
                class="block rounded-md bg-navbar px-3 py-2 text-center text-sm font-semibold text-white hover:opacity-85 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
                type="button">{{ $buttonText }}</button>
        </a>
    @endif
</div>
