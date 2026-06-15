<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LostItem;

class LostItemSeeder extends Seeder
{
    public function run(): void
    {
        LostItem::create([
            'item_name' => 'Black Backpack',
            'description' => 'Lost near college gate',
            'location' => 'College Gate',
            'contact_number' => '9876543210',
            'status' => 'Lost',
            'date' => '2026-06-20',
            'image' => 'backpack.jpg'
        ]);

        LostItem::create([
            'item_name' => 'Mobile Phone',
            'description' => 'Found near canteen',
            'location' => 'College Canteen',
            'contact_number' => '9123456780',
            'status' => 'Found',
            'date' => '2026-06-19',
            'image' => 'mobile.jpg'
        ]);
    }
}