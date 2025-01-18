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
}
