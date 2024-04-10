<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
        $plans = [
            [
                'name' => 'Standard',
                'slug' => 'standard',
                'description' => 'Plano gratuito',
                'price' => 0.00,
                'price_annual' => 0.00,
                'trial_days' => 0,
                'sort_order' => 1,
                'active' => true,
                'popular' => false,
                'recommended' => false,
                'highlighted' => false,
            ],
            [
                'name' => 'Básico',
                'slug' => 'basic',
                'description' => 'Plano básico',
                'price' => 9.99,
                'price_annual' => 99.99,
                'trial_days' => 7,
                'sort_order' => 1,
                'active' => true,
                'popular' => false,
                'recommended' => false,
                'highlighted' => false,
            ],
            [
                'name' => 'Pro',
                'slug' => 'pro',
                'description' => 'Plano Pro',
                'price' => 19.99,
                'price_annual' => 199.99,
                'trial_days' => 7,
                'sort_order' => 2,
                'active' => true,
                'popular' => true,
                'recommended' => false,
                'highlighted' => false,
            ],
            [
                'name' => 'Premium',
                'slug' => 'premium',
                'description' => 'Plano Premium',
                'price' => 29.99,
                'price_annual' => 299.99,
                'trial_days' => 7,
                'sort_order' => 3,
                'active' => true,
                'popular' => false,
                'recommended' => true,
                'highlighted' => true,
            ],
            [
                'name' => 'Enterprise',
                'slug' => 'enterprise',
                'description' => 'Plano Enterprise',
                'price' => 49.99,
                'price_annual' => 499.99,
                'trial_days' => 7,
                'sort_order' => 4,
                'active' => true,
                'popular' => false,
                'recommended' => false,
                'highlighted' => true,
            ],
            [
                'name' => 'Staff',
                'slug' => 'staff',
                'description' => 'Plano Staff',
                'price' => 0.00,
                'price_annual' => 0.00,
                'trial_days' => 0,
                'sort_order' => 5,
                'active' => true,
                'popular' => false,
                'recommended' => false,
                'highlighted' => false,
                'hidden' => true,
            ],
        ];

        foreach ($plans as $plan) {
            \App\Models\Plan::create($plan);
        }
        
    }
}
