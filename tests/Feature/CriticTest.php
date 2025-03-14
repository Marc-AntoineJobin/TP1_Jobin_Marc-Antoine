<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Critic;

class CriticTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_critic(): void
    {
        $this->seed();

        $critic = Critic::find(1);
        $response = $this->delete("/api/critics/{$critic->id}");
        $response->assertStatus(204);
        $this->assertNull(Critic::find(1));
    }

    public function test_delete_critic_with_invalid_id(): void
    {
        $this->seed();

        $response = $this->delete('/api/critics/9999');
        $response->assertStatus(404);
    }
}