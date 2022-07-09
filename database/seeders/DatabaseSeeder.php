<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\ExchangeStoreFactory;
use App\Models\ExchangeStore;
use App\Models\Client;
use App\Models\PaymentSafe;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();

         /*\App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);*/


        if(Client::count() < 10){
            Client::factory(10)->create();
        }

        if(PaymentSafe::count() < 10){
            PaymentSafe::factory(10)->create();
        }

        if(ExchangeStore::count() < 10){
            ExchangeStore::factory(10)->create();
        }

        $this->call(ModerateTableSeeder::class);
    }
}
