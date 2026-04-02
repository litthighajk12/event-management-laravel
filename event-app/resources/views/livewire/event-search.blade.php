<div class="animate-fade-in">
    <!-- Search Input -->
    <div class="bg-white rounded-xl shadow-md p-5 mb-6">
        <div class="relative">
            <input 
                type="text" 
                wire:model.live="search" 
                placeholder="🔍 Search events by title, description, or location..."
                class="w-full px-5 py-4 pl-14 border-2 border-gray-100 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all duration-200 text-gray-700 text-lg"
            >
            <div class="absolute inset-y-0 left-0 flex items-center pl-5">
                <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            @if($search)
                <button 
                    wire:click="$set('search', '')"
                    class="absolute inset-y-0 right-0 flex items-center pr-5 text-gray-400 hover:text-gray-600 transition-colors"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            @endif
        </div>
    </div>

    <!-- Sort Options -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6 flex flex-wrap gap-3">
        <span class="text-gray-500 font-medium self-center mr-2">Sort by:</span>
        <button 
            wire:click="sort('date')"
            class="px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200 flex items-center {{ $sortBy === 'date' ? 'bg-indigo-600 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600' }}"
        >
            📅 Date
            @if($sortBy === 'date')
                <svg class="w-4 h-4 ml-1 {{ $sortDirection === 'desc' ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                </svg>
            @endif
        </button>
        <button 
            wire:click="sort('title')"
            class="px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200 flex items-center {{ $sortBy === 'title' ? 'bg-purple-600 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-purple-50 hover:text-purple-600' }}"
        >
            📝 Title
            @if($sortBy === 'title')
                <svg class="w-4 h-4 ml-1 {{ $sortDirection === 'desc' ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                </svg>
            @endif
        </button>
        <button 
            wire:click="sort('price')"
            class="px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200 flex items-center {{ $sortBy === 'price' ? 'bg-pink-600 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-pink-50 hover:text-pink-600' }}"
        >
            💰 Price
            @if($sortBy === 'price')
                <svg class="w-4 h-4 ml-1 {{ $sortDirection === 'desc' ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                </svg>
            @endif
        </button>
        
        <!-- Results count -->
        <div class="ml-auto self-center text-sm text-gray-500">
            Showing {{ $events->count() }} events
        </div>
    </div>

    <!-- Events Grid -->
    @if ($events->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($events as $index => $event)
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border-t-4" style="border-color: {{ ['#6366f1', '#8b5cf6', '#ec4899', '#f43f5e', '#f97316', '#10b981', '#06b6d4', '#3b82f6'][$index % 8] }}">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-3">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700">
                                {{ \Carbon\Carbon::parse($event->date)->format('M j, Y') }}
                            </span>
                            <span class="text-lg font-bold {{ $event->price > 0 ? 'text-indigo-600' : 'text-green-600' }}">
                                @if ($event->price > 0)
                                    ${{ number_format($event->price, 2) }}
                                @else
                                    🎉 Free
                                @endif
                            </span>
                        </div>
                        
                        <h2 class="text-xl font-bold text-gray-900 mb-2 line-clamp-1">
                            <a href="{{ route('events.show', $event->id) }}" class="hover:text-indigo-600 transition-colors">
                                {{ $event->title }}
                            </a>
                        </h2>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $event->description }}</p>
                        
                        <div class="space-y-2 text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $event->location }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <span class="{{ $event->registrations->count() >= $event->capacity ? 'text-red-500' : '' }}">
                                    {{ $event->registrations->count() }} / {{ $event->capacity }} registered
                                </span>
                            </div>
                        </div>

                        <!-- Capacity Bar -->
                        <div class="mt-3">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="h-2 rounded-full transition-all duration-300 {{ $event->registrations->count() >= $event->capacity ? 'bg-red-500' : 'bg-gradient-to-r from-indigo-500 to-purple-500' }}" style="width: {{ min(($event->registrations->count() / $event->capacity) * 100, 100) }}%"></div>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('events.show', $event->id) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-medium rounded-lg transition-all duration-300">
                                View Details →
                            </a>
                            @if($event->registrations->count() >= $event->capacity)
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                    Full
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            <div class="bg-white rounded-xl shadow-md px-4 py-2">
                {{ $events->links() }}
            </div>
        </div>
    @else
        <div class="bg-white shadow-lg rounded-2xl p-10 text-center">
            <div class="mb-4">
                <svg class="w-20 h-20 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-gray-500 text-xl mb-2">No events found matching "{{ $search }}"</p>
            <button wire:click="$set('search', '')" class="mt-4 px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium rounded-lg transition-all duration-300">
                Clear search →
            </button>
        </div>
    @endif
</div>
