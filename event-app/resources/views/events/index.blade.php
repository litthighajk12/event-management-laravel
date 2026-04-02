@extends('layouts.app')

@section('content')



<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Page Header -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8 flex flex-col md:flex-row md:justify-between md:items-center">
            
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    🎉 Upcoming Events
                </h1>
                <p class="text-gray-500 mt-1">
                    Discover and register for amazing events
                </p>
            </div>

            @auth
            <div class="mt-4 md:mt-0">
                <a href="{{ route('events.create') }}"
                   class="inline-flex items-center px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition">
                    + Create Event
                </a>
            </div>
            @endauth

        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <div class="bg-white p-5 rounded-lg shadow-sm">
                <p class="text-sm text-gray-500">Browse Events</p>
                <h2 class="text-xl font-semibold text-gray-800 mt-1">Find Your Match</h2>
            </div>

            <div class="bg-white p-5 rounded-lg shadow-sm">
                <p class="text-sm text-gray-500">Search & Filter</p>
                <h2 class="text-xl font-semibold text-gray-800 mt-1">Find Quickly</h2>
            </div>

            <div class="bg-white p-5 rounded-lg shadow-sm">
                <p class="text-sm text-gray-500">Register</p>
                <h2 class="text-xl font-semibold text-gray-800 mt-1">Secure Your Spot</h2>
            </div>

        </div>

        <!-- Event Search / Listing -->
        <div class="bg-white rounded-xl shadow-sm p-6">

            {{-- If Livewire is ready --}}
            @if (class_exists(\Livewire\Livewire::class))
                @livewire('event-search')
            @else
                <p class="text-gray-500">Event search component coming soon...</p>
            @endif

        </div>

    </div>
</div>

@endsection