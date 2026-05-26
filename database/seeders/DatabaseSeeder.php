<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. USERS ──────────────────────────────────────
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@carzone.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        // Customer user for testing
        User::updateOrCreate(
            ['email' => 'customer@carzone.com'],
            [
                'name'     => 'John Customer',
                'password' => Hash::make('password'),
                'role'     => 'customer',
            ]
        );

        // ── 2. CATEGORIES ─────────────────────────────────
        $categories = [
            ['name' => 'Engine Parts',  'description' => 'Pistons, gaskets, timing belts and engine components'],
            ['name' => 'Brakes',        'description' => 'Brake pads, discs, callipers and brake fluid'],
            ['name' => 'Electrical',    'description' => 'Batteries, alternators, starters and wiring'],
            ['name' => 'Accessories',   'description' => 'Floor mats, seat covers, dash cams and more'],
            ['name' => 'Tyres',         'description' => 'All-season, performance and off-road tyres'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['name' => $cat['name']],
                ['slug' => Str::slug($cat['name']), 'description' => $cat['description']]
            );
        }

        // ── 3. PRODUCTS ───────────────────────────────────
        $products = [
            // Engine Parts (category 1)
            ['name' => 'Performance Piston Kit', 'description' => 'High-performance forged pistons for improved power output.', 'price' => 4500, 'stock' => 15, 'category' => 'Engine Parts'],
            ['name' => 'Timing Belt Set',        'description' => 'OEM quality timing belt with tensioner and water pump.', 'price' => 1800, 'stock' => 30, 'category' => 'Engine Parts'],
            ['name' => 'Head Gasket',            'description' => 'Multi-layer steel head gasket for all engine types.', 'price' => 850,  'stock' => 50, 'category' => 'Engine Parts'],
            ['name' => 'Engine Air Filter',      'description' => 'High-flow air filter for better engine breathing.', 'price' => 350,  'stock' => 80, 'category' => 'Engine Parts'],

            // Brakes (category 2)
            ['name' => 'Front Brake Pads Set',   'description' => 'Ceramic brake pads for smooth, quiet braking.', 'price' => 1200, 'stock' => 40, 'category' => 'Brakes'],
            ['name' => 'Rear Brake Discs Pair',  'description' => 'Slotted and drilled ventilated brake discs.', 'price' => 2800, 'stock' => 20, 'category' => 'Brakes'],
            ['name' => 'Brake Calliper Set',     'description' => 'Complete front brake calliper set with hardware.', 'price' => 3200, 'stock' => 10, 'category' => 'Brakes'],
            ['name' => 'Brake Fluid DOT4',       'description' => '1 litre DOT4 high-performance brake fluid.', 'price' => 280,  'stock' => 100,'category' => 'Brakes'],

            // Electrical (category 3)
            ['name' => 'Car Battery 60Ah',       'description' => 'Maintenance-free 12V 60Ah battery, 5-year warranty.', 'price' => 5500, 'stock' => 12, 'category' => 'Electrical'],
            ['name' => 'Alternator 90A',         'description' => 'Remanufactured 90A alternator, plug and play.', 'price' => 4800, 'stock' => 8,  'category' => 'Electrical'],
            ['name' => 'Starter Motor',          'description' => 'High-torque starter motor for reliable cold starts.', 'price' => 3600, 'stock' => 5,  'category' => 'Electrical'],
            ['name' => 'LED Headlight Bulbs H4', 'description' => 'Pair of 6000K white LED headlight bulbs, plug in.', 'price' => 1200, 'stock' => 60, 'category' => 'Electrical'],

            // Accessories (category 4)
            ['name' => 'All-Weather Floor Mats', 'description' => 'Custom fit rubber floor mats, set of 4.', 'price' => 950,  'stock' => 35, 'category' => 'Accessories'],
            ['name' => 'Dash Cam 4K',            'description' => '4K WiFi dash camera with night vision and GPS.', 'price' => 3800, 'stock' => 18, 'category' => 'Accessories'],
            ['name' => 'Seat Cover Set',         'description' => 'Leather-look seat covers for front and rear.', 'price' => 2200, 'stock' => 22, 'category' => 'Accessories'],
            ['name' => 'Car Phone Mount',        'description' => 'Magnetic air vent phone holder, 360° rotation.', 'price' => 450,  'stock' => 90, 'category' => 'Accessories'],

            // Tyres (category 5)
            ['name' => 'All-Season Tyre 205/55R16', 'description' => 'Balanced performance in wet and dry conditions.', 'price' => 4200, 'stock' => 20, 'category' => 'Tyres'],
            ['name' => 'Performance Tyre 225/45R17', 'description' => 'High-grip ultra-performance summer tyre.', 'price' => 6500, 'stock' => 14, 'category' => 'Tyres'],
            ['name' => 'Off-Road Tyre 265/70R17',   'description' => 'Aggressive mud-terrain tyre for 4x4 vehicles.', 'price' => 7800, 'stock' => 8,  'category' => 'Tyres'],
            ['name' => 'Budget Tyre 175/65R14',     'description' => 'Reliable economy tyre for city driving.', 'price' => 2100, 'stock' => 40, 'category' => 'Tyres'],
        ];

        foreach ($products as $p) {
            $category = Category::where('name', $p['category'])->first();
            Product::updateOrCreate(
                ['name' => $p['name']],
                [
                    'slug'        => Str::slug($p['name']) . '-' . rand(100, 999),
                    'description' => $p['description'],
                    'price'       => $p['price'],
                    'stock'       => $p['stock'],
                    'image'       => null,
                    'category_id' => $category->id,
                ]
            );
        }

        $this->command->info('✅ CarZone seeded: 2 users, 5 categories, 20 products.');
    }
}
