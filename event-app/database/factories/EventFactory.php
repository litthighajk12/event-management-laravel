<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Event>
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Realistic event titles
        $titles = [
            'Tech Conference 2024',
            'Annual Music Festival',
            'Business Networking Event',
            'Art Exhibition Opening',
            'Startup Pitch Night',
            'Food & Wine Festival',
            'Marathon Charity Run',
            'Photography Workshop',
            'Leadership Summit',
            'Comedy Night Live',
            'Digital Marketing Workshop',
            'Yoga in the Park',
            'Book Club Meeting',
            'Gaming Tournament',
            'Culinary Masterclass',
            'Investment Seminar',
            'Dance Performance',
            'Science Fair',
            'Wine Tasting Evening',
            'Outdoor Movie Night',
            'Hackathon 2024',
            'Fashion Show',
            'Environmental Conference',
            'Cooking Class',
            'Live Concert',
        ];

        // Realistic locations
        $locations = [
            'Convention Center, Downtown',
            'Central Park, New York',
            'Tech Hub, San Francisco',
            'Grand Hotel Ballroom',
            'Community Center, Seattle',
            'Arts District, Los Angeles',
            'Waterfront Venue, Chicago',
            'University Auditorium',
            'Rooftop Lounge, Miami',
            'Historic Theater, Boston',
            'Conference Hall, Austin',
            'Gallery Space, Portland',
            'Sports Complex, Denver',
            'Beach Resort, San Diego',
            'Mountain Lodge, Colorado',
        ];

        // Sample descriptions
        $descriptions = [
            'Join us for an incredible day of learning and networking with industry leaders. This event brings together professionals from across the country to share insights and best practices.',
            'Experience the best local food and beverages at our annual festival. Meet artisan vendors, enjoy live demonstrations, and taste exclusive creations.',
            'A unique opportunity to connect with fellow professionals and expand your network. Light refreshments will be provided.',
            'Discover the latest innovations in technology and business. Featuring keynote speakers, panel discussions, and interactive workshops.',
            'An evening of entertainment featuring talented performers from around the world. VIP seating and meet-and-greet available.',
            'Learn from expert instructors in this hands-on workshop. All skill levels welcome, from beginners to advanced practitioners.',
            'Test your skills in our exciting competition with prizes and recognition. Open to all ages and experience levels.',
            'A family-friendly event with activities for everyone. Bring your friends and family for a day of fun and memories.',
            'Exclusive access to industry insights and trends. Network with thought leaders and gain a competitive edge in your field.',
            'Immerse yourself in culture and creativity. Art installations, live performances, and interactive experiences await.',
        ];

        $title = $this->faker->unique()->randomElement($titles);
        
        // Generate future dates (within next 6 months)
        $date = $this->faker->dateTimeBetween('now', '+6 months');

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->randomElement($descriptions),
            'date' => $date->format('Y-m-d'),
            'location' => $this->faker->randomElement($locations),
            'capacity' => $this->faker->numberBetween(20, 500),
            'price' => $this->faker->randomFloat(2, 0, 250),
        ];
    }

    /**
     * Indicate that the event is free.
     */
    public function free(): static
    {
        return $this->state(fn (array $attributes) => [
            'price' => 0,
        ]);
    }

    /**
     * Indicate that the event is a large conference.
     */
    public function largeConference(): static
    {
        return $this->state(fn (array $attributes) => [
            'capacity' => $this->faker->numberBetween(300, 1000),
            'price' => $this->faker->randomFloat(2, 100, 500),
        ]);
    }

    /**
     * Indicate that the event has an image.
     */
    public function withImage(): static
    {
        return $this->state(fn (array $attributes) => [
            'image' => 'events/placeholder-' . $this->faker->numberBetween(1, 10) . '.jpg',
        ]);
    }
}
