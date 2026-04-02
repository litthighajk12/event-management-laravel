<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class EventSearch extends Component
{
    use WithPagination;

    public string $search = '';
    public string $sortBy = 'date';
    public string $sortDirection = 'asc';

    /**
     * Livewire lifecycle hook - runs when any property changes
     * This automatically resets pagination when search changes
     */
    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Computed property - returns filtered events (only future events)
     */
    public function getEventsProperty()
    {
        return Event::query()
            // Only show future events
            ->where('date', '>=', now()->toDateString())
            // Search filter
            ->when($this->search, function ($query) {
                $query->where('title', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%")
                    ->orWhere('location', 'like', "%{$this->search}%");
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(12);
    }

    /**
     * Toggle sort direction
     */
    public function sort(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        return view('livewire.event-search', [
            'events' => $this->events,
        ]);
    }
}
