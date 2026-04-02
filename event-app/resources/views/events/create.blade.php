@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Back Button -->
        <a href="{{ route('events.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-4 font-medium transition-colors">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Events
        </a>

        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6">
                <h1 class="text-2xl font-bold text-white flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create New Event
                </h1>
                <p class="text-indigo-100 mt-1">Fill in the details to create a new event</p>
            </div>

            <div class="p-6">
                <form action="{{ route('events.store') }}" method="POST">
                    @csrf

                    <!-- Title -->
                    <div class="mb-5">
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <span class="w-6 h-6 bg-indigo-100 rounded-full flex items-center justify-center mr-2 text-indigo-600 text-xs">1</span>
                            Event Title
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition-all duration-200"
                            placeholder="Enter a catchy title for your event">
                        @error('title')
                            <p class="mt-2 text-sm text-red-500 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-5">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <span class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center mr-2 text-purple-600 text-xs">2</span>
                            Description
                        </label>
                        <textarea name="description" id="description" rows="5" required
                            class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 outline-none transition-all duration-200 resize-none"
                            placeholder="Describe your event in detail...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-500 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div class="mb-5">
                        <label for="date" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <span class="w-6 h-6 bg-pink-100 rounded-full flex items-center justify-center mr-2 text-pink-600 text-xs">3</span>
                            Event Date
                        </label>
                        <input type="date" name="date" id="date" value="{{ old('date') }}" required
                            class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-pink-500 focus:ring-4 focus:ring-pink-100 outline-none transition-all duration-200">
                        @error('date')
                            <p class="mt-2 text-sm text-red-500 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div class="mb-5">
                        <label for="location" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <span class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-2 text-green-600 text-xs">4</span>
                            Location
                        </label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" required
                            class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-100 outline-none transition-all duration-200"
                            placeholder="Enter the event location">
                        @error('location')
                            <p class="mt-2 text-sm text-red-500 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Capacity & Price Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                        <div>
                            <label for="capacity" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <span class="w-6 h-6 bg-orange-100 rounded-full flex items-center justify-center mr-2 text-orange-600 text-xs">5</span>
                                Capacity
                            </label>
                            <input type="number" name="capacity" id="capacity" value="{{ old('capacity') }}" required min="1"
                                class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all duration-200"
                                placeholder="Max attendees">
                            @error('capacity')
                                <p class="mt-2 text-sm text-red-500 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="price" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <span class="w-6 h-6 bg-cyan-100 rounded-full flex items-center justify-center mr-2 text-cyan-600 text-xs">6</span>
                                Price ($)
                            </label>
                            <input type="number" name="price" id="price" value="{{ old('price', 0) }}" required min="0" step="0.01"
                                class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100 outline-none transition-all duration-200"
                                placeholder="0.00">
                            @error('price')
                                <p class="mt-2 text-sm text-red-500 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                        <a href="{{ route('events.index') }}" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all duration-200">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Create Event 🎉
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
