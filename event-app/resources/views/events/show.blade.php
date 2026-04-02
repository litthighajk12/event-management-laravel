@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg shadow-md animate-fade-in" role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg shadow-md animate-fade-in" role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Back Button -->
        <a href="{{ route('events.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-4 font-medium transition-colors">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Events
        </a>

        <!-- Event Details Card -->
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 p-8">
                <h1 class="text-4xl font-bold text-white mb-2">{{ $event->title }}</h1>
                <div class="flex flex-wrap gap-4 text-indigo-100">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}
                    </span>
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $event->location }}
                    </span>
                </div>
            </div>
            
            <div class="p-8">
                <!-- Event Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl p-5 border border-indigo-100">
                        <h3 class="text-sm font-semibold text-indigo-600 uppercase tracking-wider mb-2">📅 Date & Time</h3>
                        <p class="text-gray-900 font-bold text-lg">{{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y') }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-5 border border-purple-100">
                        <h3 class="text-sm font-semibold text-purple-600 uppercase tracking-wider mb-2">💵 Price</h3>
                        <p class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                            @if ($event->price > 0)
                                ${{ number_format($event->price, 2) }}
                            @else
                                🎉 Free
                            @endif
                        </p>
                    </div>
                    <div class="bg-gradient-to-br from-pink-50 to-red-50 rounded-xl p-5 border border-pink-100">
                        <h3 class="text-sm font-semibold text-pink-600 uppercase tracking-wider mb-2">👥 Capacity</h3>
                        <p class="text-gray-900 font-bold text-lg">{{ $event->registrations->count() }} / {{ $event->capacity }} registered</p>
                        <div class="mt-2 w-full bg-gray-200 rounded-full h-3">
                            <div class="h-3 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 transition-all duration-300" style="width: {{ min(($event->registrations->count() / $event->capacity) * 100, 100) }}%"></div>
                        </div>
                        @if($event->registrations->count() >= $event->capacity)
                            <span class="inline-block mt-2 px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                ⚠️ Event Full
                            </span>
                        @else
                            <span class="inline-block mt-2 px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                ✓ Available Spots
                            </span>
                        @endif
                    </div>
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-5 border border-green-100">
                        <h3 class="text-sm font-semibold text-green-600 uppercase tracking-wider mb-2">📊 Status</h3>
                        <p class="text-gray-900 font-bold text-lg">
                            @if($event->date >= now()->toDateString())
                                <span class="text-green-600">Upcoming</span>
                            @else
                                <span class="text-gray-500">Past Event</span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center">
                        <span class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3 text-indigo-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                        </span>
                        About This Event
                    </h3>
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                        <p class="text-gray-600 whitespace-pre-wrap leading-relaxed">{{ $event->description }}</p>
                    </div>
                </div>

                <!-- Registration Section -->
                @auth
                    @php
                        $isRegistered = $event->registrations->contains('user_id', auth()->id());
                        $isFull = $event->registrations->count() >= $event->capacity;
                    @endphp

                    <div class="border-t-2 border-dashed border-gray-200 pt-8">
                        @if ($isRegistered)
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 rounded-xl p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-green-800 text-lg">You're Registered! 🎉</p>
                                        <p class="text-green-600 text-sm">Your spot has been reserved for this event.</p>
                                    </div>
                                </div>
                                <form action="{{ route('events.unregister', $event->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-100 hover:bg-red-200 text-red-700 font-medium rounded-lg transition-colors">
                                        ❌ Cancel Registration
                                    </button>
                                </form>
                            </div>
                        @elseif ($isFull)
                            <div class="bg-gradient-to-r from-red-50 to-orange-50 border-2 border-red-200 rounded-xl p-6">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-red-800 text-lg">Event is Full</p>
                                        <p class="text-red-600 text-sm">Unfortunately, there are no more spots available.</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <form action="{{ route('events.register', $event->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-lg">
                                    🎫 Register for this Event
                                </button>
                            </form>
                        @endif
                    </div>
                @else
                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 border-2 border-indigo-100 rounded-xl p-6 text-center">
                        <p class="text-gray-600 mb-4">Please log in to register for this event</p>
                        <div class="flex justify-center gap-4">
                            <a href="{{ route('login') }}" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-md">
                                Log In
                            </a>
                            <a href="{{ route('register') }}" class="px-6 py-3 bg-white border-2 border-indigo-200 text-indigo-600 font-semibold rounded-xl hover:bg-indigo-50 transition-all duration-300">
                                Register
                            </a>
                        </div>
                    </div>
                @endauth

                <!-- Edit/Delete (only for admin or owner) -->
                @auth
                    @if(auth()->user()->role === 'admin' || auth()->id() === $event->user_id)
                        <div class="border-t-2 border-dashed border-gray-200 pt-6 mt-6 flex flex-wrap justify-between items-center gap-4">
                            <a href="{{ route('events.index') }}" class="text-gray-500 hover:text-gray-700 font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Events
                            </a>
                            <div class="flex gap-3">
                                @if(auth()->user()->role === 'admin' || auth()->id() === $event->user_id)
                                    <a href="{{ route('events.edit', $event->id) }}" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-300">
                                        ✏️ Edit Event
                                    </a>
                                @endif
                                @if(auth()->user()->role === 'admin')
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-100 hover:bg-red-200 text-red-700 font-medium rounded-lg transition-colors" onclick="return confirm('Are you sure you want to delete this event?')">
                                            🗑️ Delete Event
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
