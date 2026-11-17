<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@pickleball.test',
            'password' => Hash::make('Admin@12345'),
        ]);
        
        $items = [
            ['Carbon Fiber Paddle', 'Paddles', 3200, 'Carbon fiber face, polymer honeycomb core, 16 mm thick.', 'available'],
            ['Fiberglass Paddle', 'Paddles', 1800, 'Fiberglass face, lightweight, 8 oz.', 'unavailable'],
            ['Indoor Pickleball Pack', 'Balls', 450, 'Pack of 6 indoor balls, 26 holes.', 'available'],
            ['Outdoor Pickleball Pack', 'Balls', 520, 'Pack of 6 outdoor balls, 40 holes, UV resistant.', 'available'],
            ['Portable Pickleball Net', 'Nets', 4500, 'Regulation 22 ft net with steel frame and carry bag.', 'unavailable'],
            ['Replacement Net', 'Nets', 1200, 'Replacement 22 ft mesh net, no frame.', 'available'],
            ['Paddle Grip Tape', 'Accessories', 150, 'Anti-slip overgrip, pack of 3.', 'available'],
            ['Pickleball Equipment Bag', 'Accessories', 1100, 'Holds 4 paddles and 6 balls, water resistant.', 'unavailable'],
        ];

        foreach ($items as [$name, $cat, $price, $desc, $status]) {
            Equipment::create([
                'user_id' => $admin->id, 'equipment_name' => $name, 'category' => $cat,
                'unit_price' => $price, 'description' => $desc, 'availability_status' => $status,
            ]);
        }
    }
}