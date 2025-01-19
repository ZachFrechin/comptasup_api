<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase;
use App\Http\Controllers\DepenseController;
use App\Http\Requests\Depense\DepenseCreateRequest;
use App\Models\Depense;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class DepenseControllerTest extends TestCase
{

    public function test_index_returns_a_collection_of_depenses()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $depense = Depense::create([
            "totalTTC" => 100,
            "date" => "2022-01-01",
            "details" => json_encode(["reason" => "test"]),
            "nature_id" => 1,
            "tiers" => "John Doe"
        ]);

        $response = $this->get('/api/depense');
        $response->assertStatus(200);
        $this->assertNotEmpty($response->json('data'));

        $depense->delete();
        $user->delete();
    }

    public function test_show_returns_a_single_depense()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $depense = Depense::create([
            "totalTTC" => 100,
            "date" => "2022-01-01",
            "details" => json_encode(["reason" => "test"]),
            "nature_id" => 1,
            "tiers" => "John Doe"
        ]);

        $response = $this->get('/api/depense/' . $depense->id);
        $response->assertStatus(200);
        $this->assertNotEmpty($response->json('data'));

        $depense->delete();
        $user->delete();
    }

    public function test_show_returns_a_404_not_found_when_depense_does_not_exist()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->get('/api/depense/99999');
        $response->assertStatus(404);

        $user->delete();
    }

    public function test_store_success()
    {

        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        
        $request = [
            'nom' => 'test',
            'note_id' => 1,
            'nature_id' => 1,
            'totalTTC' => 100,
            'date' => '2022-01-01',
            'tiers' => 'John Doe',
            'details' => '{"reason": "test"}',
        ];

        $response = $this->postJson('api/depense/store', $request);

        $response->assertStatus(201);
        $this->assertNotNull(Depense::find(1));

        Depense::latest()->first()->delete();
        $user->delete();
    }

    public function test_store_failure_missing_required_parameters()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $request = [
            'totalTTC' => 100,
            'date' => '2022-01-01',
            'tiers' => 'John Doe',
            'details' => '{"reason": "test"}',
        ];

        $response = $this->postJson('api/depense/store', $request);

        $response->assertStatus(422);
    }

    public function test_store_failure_invalid_nature_id()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $request = [
            'nom' => 'test',
            'nature_id' => 9994345,
            'totalTTC' => 100,
            'date' => '2022-01-01',
            'tiers' => 'John Doe',
            'details' => '{"reason": "test"}',
        ];

        $response = $this->postJson('api/depense/store', $request);

        $response->assertStatus(422);
    }

    public function test_store_file_upload_failure()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $request = [
            'nom' => "test",
            'nature_id' => 1,
            'totalTTC' => 100,
            'date' => '2022-01-01',
            'tiers' => 'John Doe',
            'details' => '{"reason": "test"}',
        ];

        $response = $this->postJson('api/depense/store', $request, ['file' => UploadedFile::fake()->create('test.pdf')]);

        $response->assertStatus(201);
        $this->assertFalse(Storage::disk('public')->exists('depenses/1/test.pdf'));
    }

    public function test_getFile_returns_valid_file_when_exists()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $depense = Depense::create([
            "totalTTC" => 100,
            "date" => "2022-01-01",
            "details" => json_encode(["reason" => "test"]),
            "nature_id" => 1,
            "tiers" => "John Doe"
        ]);

        $filename = 'example.txt';
        Storage::fake('public');
        Storage::put("public/depenses/{$depense->id}/{$filename}", 'Hello World');

        $response = $this->get('/api/depense/getfile/' . $depense->id . '/' . $filename);
        $response->assertStatus(200);

        $depense->delete();
        $user->delete();
    }

    public function test_getFile_returns_404_when_file_does_not_exist()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $depense = Depense::create([
            "totalTTC" => 100,
            "date" => "2022-01-01",
            "details" => json_encode(["reason" => "test"]),
            "nature_id" => 1,
            "tiers" => "John Doe"
        ]);

        $filename = 'non_existent_file.txt';
        $response = $this->get('/api/depense/getfile/' . $depense->id . '/' . $filename);
        $response->assertStatus(404);

        $depense->delete();
        $user->delete();
    }

    public function test_getFile_return_404_when_filename_is_null()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $filename = 'example.txt';
        $response = $this->getJson('/api/depense/getfile/' . $filename . '/null');
        $response->assertStatus(404);

        $user->delete();
    }

    public function test_getFile_throws_error_when_filename_is_null_or_empty()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $depense = Depense::create([
            "totalTTC" => 100,
            "date" => "2022-01-01",
            "details" => json_encode(["reason" => "test"]),
            "nature_id" => 1,
            "tiers" => "John Doe"
        ]);

        $response = $this->getJson('/api/depense/getfile/' . $depense->id . '/null');
        $response->assertStatus(404);
        $response = $this->getJson('/api/depense/getfile/' . $depense->id . '/');
        $response->assertStatus(404);
        $depense->delete();
        $user->delete();
    }

    public function test_update_returns_a_single_depense()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $depense = Depense::create([
            "totalTTC" => 100,
            "date" => "2022-01-01",
            "details" => json_encode(["reason" => "test"]),
            "nature_id" => 1,
            "tiers" => "John Doe"
        ]);

        $request = [
            'details' => json_encode(["reason" => "updated test"]),
        ];

        $response = $this->put('/api/depense/' . $depense->id, $request);
        $response->assertStatus(201);
        $this->assertNotEmpty($response->json('data'));

        $depense->delete();
        $user->delete();
    }

    public function test_update_returns_a_422_when_request_is_invalid()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $depense = Depense::create([
            "totalTTC" => 100,
            "date" => "2022-01-01",
            "details" => json_encode(["reason" => "test"]),
            "nature_id" => 1,
            "tiers" => "John Doe"
        ]);

        $request = [
            'invalid_field' => 'invalid value',
        ];

        $response = $this->put('/api/depense/' . $depense->id, $request);
        $response->assertStatus(422);

        $depense->delete();
        $user->delete();
    }

    public function test_update_returns_a_404_when_depense_does_not_exist()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $request = [
            'details' => json_encode(["reason" => "updated test"]),
        ];

        $response = $this->put('/api/depense/99999', $request);
        $response->assertStatus(404);

        $user->delete();
    }
}
