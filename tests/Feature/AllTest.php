<?php

namespace Tests\Feature;

use App\Enums\DiseaseType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class AllTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegions()
    {
        $response = $this->get('/api/regions');

        $response->assertStatus(200);
        Log::info($response->json());
    }

    public function testSearch()
    {
        $response = $this->get('/api/search?region_id=1&type=1&disease=' . DiseaseType::crown());

        $response->assertStatus(200);
        Log::info($response->json());
    }
}
