@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Welcome, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-gray-600 mt-2">
                        Here you can view your registered events and manage your registrations.
                    </p>
                </div>
            </div>

            <!-- My Registered Events -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800">My Registered Events</h3>
                </div>
                
                <div class="p-6">
                    @php
                        // Get user's registrations through the relationship
                        $registrations = Auth::user()->registrations()->with('event')->get();
                    @endphp

                    @if ($registrations->count() > 0)
                        <div class="space-y-4">
                            @foreach ($registrations as $registration)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border">
                                    <div>
                                        <h4 class="text-lg font-medium text-gray-900">
                                            <a href="{{ route('events.show', $registration->event->id) }}" class="hover:text-indigo-600">
                                                {{ $registration->event->title }}
                                            </a>
                                        </h4>
                                        <div class="mt-1 text-sm text-gray-500">
                                            <span>{{ \Carbon\Carbon::parse($registration->event->date)->format('F j, Y') }}</span>
                                            <span class="mx-2">•</span>
                                            <span>{{ $registration->event->location }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Registered
                                        </span>
                                        <form action="{{ route('events.unregister', $registration->event->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                                Cancel
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-lg">You haven't registered for any events yet.</p>
                            <a href="{{ route('events.index') }}" class="mt-4 inline-block text-indigo-600 hover:text-indigo-900 font-medium">
                                Browse Events →
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('events.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition-shadow">
                    <h4 class="text-lg font-semibold text-gray-800">Browse All Events</h4>
                    <p class="text-gray-600 mt-2">Discover and register for upcoming events.</p>
                </a>
                @if(auth()->user()->is_admin)
                <a href="{{ route('admin.events.create') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition-shadow">
                    <h4 class="text-lg font-semibold text-gray-800">Create an Event</h4>
                    <p class="text-gray-600 mt-2">Host your own event and invite others.</p>
                </a>
                @endif
            </div>
        </div>
    </div>
@endsection
