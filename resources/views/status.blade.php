@extends('layouts.public')

@section('main')
    <div class="max-w-sm mx-auto">
        <div class="text-center mt-20">
            <img class="mx-auto h-24 w-24" src="{{ setting('community.logo_url') }}" alt="Community Logo">
            <h1 class="text-2xl font-bold mt-2">{{ setting('community.name') }} CAD</h1>
            <p class="text-gray-400 mt-2 leading-0">Mobile Data Terminal</p>
        </div>

        <div class="border border-gray-600 mt-8 p-6 text-center">
            <p class="text-xs font-semibold uppercase tracking-widest text-gray-500">Account Status</p>
            <h2 class="text-xl font-bold mt-2">{{ $status }}</h2>
            <p class="text-gray-400 mt-2 text-sm">{{ $description }}</p>

            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit"
                    class="text-sm text-gray-500 hover:text-gray-300 transition-colors cursor-pointer underline">
                    Sign out
                </button>
            </form>
        </div>
    </div>
@endsection
