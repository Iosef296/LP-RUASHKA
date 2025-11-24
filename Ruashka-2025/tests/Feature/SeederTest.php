<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Seeders\StoreSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeederTest extends TestCase
{
    // use RefreshDatabase; // Don't wipe the DB, just try to run the seeder

    public function test_store_seeder_runs()
    {
        $this->seed(StoreSeeder::class);
        $this->assertTrue(true);
    }
}
