<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Basic Photo Session',
                'description' => 'Perfect for individuals or couples. Includes 1-hour photo session and 10 edited digital photos.',
                'price' => 299.99,
                'duration' => '1 hour',
                'status' => 'active',
            ],
            [
                'name' => 'Family Portrait Package',
                'description' => 'Ideal for families up to 6 people. Includes 2-hour photo session, 20 edited digital photos, and 1 printed photo album.',
                'price' => 499.99,
                'duration' => '2 hours',
                'status' => 'active',
            ],
            [
                'name' => 'Wedding Photography',
                'description' => 'Complete wedding day coverage. Includes 8 hours of photography, 200+ edited digital photos, engagement session, and premium photo album.',
                'price' => 1999.99,
                'duration' => '8 hours',
                'status' => 'active',
            ],
            [
                'name' => 'Event Coverage',
                'description' => 'Professional photography for corporate events, parties, or special occasions. Includes 4 hours of coverage and 100 edited digital photos.',
                'price' => 799.99,
                'duration' => '4 hours',
                'status' => 'active',
            ],
            [
                'name' => 'Professional Headshots',
                'description' => 'Perfect for business professionals. Includes 30-minute session and 5 fully edited headshots.',
                'price' => 149.99,
                'duration' => '30 minutes',
                'status' => 'active',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
