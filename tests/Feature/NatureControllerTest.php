<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\NatureController;
use App\Http\Resources\NatureResource;
use App\Models\Nature;
use App\Models\User;

class NatureControllerTest extends TestCase
{
    public function test_index_returns_successful_response()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $nature = Nature::create([
            "numero" => 80,
            "nom" => "test",
            "descriptor" => json_encode(["test" => "test"]),
        ]);

        $response = $this->get("/api/nature");
        $response->assertStatus(200);

        $nature->delete();
        $user->delete();
    }

    public function test_index_returns_collection_of_nature_resources()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $nature = Nature::create([
            "numero" => 80,
            "nom" => "test",
            "descriptor" => json_encode(["test" => "test"]),
        ]);

        $response = $this->get("/api/nature");
        $response->assertStatus(200);
        $this->assertNotEmpty($response->json('data'));

        $nature->delete();
        $user->delete();
    }
}