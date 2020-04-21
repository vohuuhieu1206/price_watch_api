<?php

use App\User;
use App\Price;
use App\Follow;
use App\Review;
use App\Provider;
use App\NewsLetter;
use App\Specification;
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        // Provider::truncate();
        // Specification::truncate();
        // Review::truncate();
        // Price::truncate();
        Follow::truncate();
        NewsLetter::truncate();

        $usersQuantity = 1000 ;
        $newslettersQuantity = 1000 ;

        User::flushEventListeners();
        NewsLetter::flushEventListeners();
        
        factory(User::class, $usersQuantity)->create();
        factory(NewsLetter::class, $newslettersQuantity)->create();

        // Provider::flushEventListeners();
        // Specification::flushEventListeners();        
        // Review::flushEventListeners();
        // Price::flushEventListeners();
        // Follow::flushEventListeners();

        //$this->call(ProvidersSeeder::class);

    }
}
