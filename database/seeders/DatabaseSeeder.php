<?php

namespace Database\Seeders;

use App\Models\Bid;
use App\Models\Category;
use App\Models\Opinion;
use App\Models\Request;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        Category::factory(20)->has(Service::factory()->count(5))->create();
        User::factory(20)->create()->each(function ($user) {
            $services = Service::all();
            foreach ($services as $services) {
                $requets = Request::factory([
                    'user_id' => $user->id,
                    'service_id' => $services->id,
                    'category_id' => $services->category->id,
                ])->count(5)->create();

                // Create bids for requests
                $requets->each(function ($requet) {
                    Bid::factory([
                        'user_id' => User::inRandomOrder()->first()->id,
                        'request_id' => $requet->id
                    ])->count(rand(2, 5))->create();
                });

                // Create at least one active offer for the user
                if ($user->type === "supplier") {
                    foreach ($requets as $requet) {
                        Bid::factory([
                            'user_id' => $user->id,
                            'request_id' => $requet->id,
                            'status' => 'pending'
                        ])->create();
                    }
                }
            }

            // Create opinions for user only
            Opinion::factory([
                'supplier_id' => $user->id,
            ])->count(rand(10, 30))->create();

            if ($user->type === "supplier") {
                $ids = Category::limit(rand(3, 10))->get()->pluck('id');
                $user->categories()->attach($ids);
            }
        });
    }
}
