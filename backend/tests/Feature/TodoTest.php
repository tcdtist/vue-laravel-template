<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_todos()
    {
        Todo::factory()->count(3)->create();

        $response = $this->getJson('/api/todos');

        $response->assertStatus(200)
                ->assertJsonCount(3);
    }

    public function test_can_create_todo()
    {
        $response = $this->postJson('/api/todos', [
            'title' => 'Test Todo',
            'completed' => false
        ]);

        $response->assertStatus(201)
                ->assertJsonFragment([
                    'title' => 'Test Todo',
                    'completed' => false
                ]);
    }

    public function test_can_update_todo()
    {
        $todo = Todo::factory()->create();

        $response = $this->putJson("/api/todos/{$todo->id}", [
            'completed' => true
        ]);

        $response->assertStatus(200)
                ->assertJsonFragment([
                    'completed' => true
                ]);
    }

    public function test_can_delete_todo()
    {
        $todo = Todo::factory()->create();

        $response = $this->deleteJson("/api/todos/{$todo->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }
}
