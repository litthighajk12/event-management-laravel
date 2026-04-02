<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     * This function shows all events in the system.
     * URL: /events (GET)
     */
    public function index()
    {
        // Fetch all events from database, ordered by date
        $events = Event::orderBy('date', 'asc')->get();
        
        // Pass events to the view
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     * This function shows the create event form.
     * URL: /events/create (GET)
     */
    public function create()
    {
        // Return the create form view
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     * This function saves the new event to the database.
     * URL: /events (POST)
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after_or_equal:today',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Create the event in database
        Event::create($validated);

        // Redirect to events list with success message
        return redirect()->route('events.index')
            ->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     * This function shows a single event details.
     * URL: /events/{id} (GET)
     */
    public function show(Event $event)
    {
        // Return the event details view
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     * This function shows the edit event form.
     * URL: /events/{id}/edit (GET)
     */
    public function edit(Event $event)
    {
        // Return the edit form with event data
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     * This function updates the event in the database.
     * URL: /events/{id} (PUT/PATCH)
     */
    public function update(Request $request, Event $event)
    {
        // Validate the form data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Update the event in database
        $event->update($validated);

        // Redirect to event details with success message
        return redirect()->route('events.show', $event->id)
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * This function deletes the event from the database.
     * URL: /events/{id} (DELETE)
     */
    public function destroy(Event $event)
    {
        // Delete the event from database
        $event->delete();

        // Redirect to events list with success message
        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully!');
    }

    /**
     * Register the user for an event.
     * This function creates a registration record.
     * URL: /events/{id}/register (POST)
     */
    public function register(Request $request, Event $event)
    {
        // Get the currently authenticated user
        $user = $request->user();

        // Check if user is already registered
        $existingRegistration = $event->registrations()
            ->where('user_id', $user->id)
            ->first();

        if ($existingRegistration) {
            return redirect()->route('events.show', $event->id)
                ->with('error', 'You are already registered for this event!');
        }

        // Check if event has capacity
        $registeredCount = $event->registrations()->count();
        if ($registeredCount >= $event->capacity) {
            return redirect()->route('events.show', $event->id)
                ->with('error', 'This event is full!');
        }

        // Create the registration
        $event->registrations()->create([
            'user_id' => $user->id,
        ]);

        return redirect()->route('events.show', $event->id)
            ->with('success', 'You have registered for this event!');
    }

    /**
     * Cancel the user's registration for an event.
     * This function removes the registration record.
     * URL: /events/{id}/unregister (DELETE)
     */
    public function unregister(Request $request, Event $event)
    {
        // Get the currently authenticated user
        $user = $request->user();

        // Find and delete the registration
        $event->registrations()
            ->where('user_id', $user->id)
            ->delete();

        return redirect()->route('events.show', $event->id)
            ->with('success', 'You have cancelled your registration!');
    }
}
