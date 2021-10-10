<?php

namespace Tests\Feature;

use Tests\TestCase;

class TaskTest extends TestCase
{
    public function testListTasks()
    {
        $response = $this->json('GET', '/api/projects');
        $response->assertStatus(200);

        $project = $response->getData()->payload[0];

        $response = $this->json('GET', '/api/projects/' . $project->id . '/tasks');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                'error',
                'payload' => [
                    [
                        'id',
                        'project_id',
                        'name',
                        'start',
                        'finish',
                        'created_at',
                        'updated_at',
                        'status',
                        'project' => [
                            'id',
                            'name',
                            'start',
                            'finish',
                            'created_at',
                            'updated_at',
                        ]
                    ]
                ]
            ]
        );
    }

    public function testCreateTask()
    {
        $data = [
            'name' => 'New Task',
            'start' => "2021-10-08",
            'finish' => '2021-10-10',
        ];

        $response = $this->json('GET', '/api/projects');
        $response->assertStatus(200);

        $project = $response->getData()->payload[0];

        $response = $this->json('POST', '/api/projects/' . $project->id . '/tasks', $data);
        $response->assertStatus(201);
        $response->assertJson(['error' => false]);
        $response->assertJsonStructure(
            [
                'error',
                'payload' => [
                    'id',
                    'project_id',
                    'name',
                    'start',
                    'finish',
                    'created_at',
                    'updated_at',
                    'status',
                ]
            ]
        );
    }

    public function testDeleteTask()
    {
        $response = $this->json('GET', '/api/projects');
        $response->assertStatus(200);

        $project = $response->getData()->payload[0];

        $response = $this->json('GET', '/api/projects/' . $project->id . '/tasks');
        $response->assertStatus(200);

        $task = $response->getData()->payload[0];

        $delete = $this->json('DELETE', '/api/projects/' . $project->id . '/tasks/' . $task->id);
        $delete->assertStatus(200);
        $delete->assertJson(['payload' => true]);
    }

    public function testUpdateTask()
    {
        $response = $this->json('GET', '/api/projects');
        $response->assertStatus(200);

        $project = $response->getData()->payload[0];

        $response = $this->json('GET', '/api/projects/' . $project->id . '/tasks');
        $response->assertStatus(200);

        $task = $response->getData()->payload[0];

        $update = $this->json('PUT', '/api/projects/' . $project->id . '/tasks/' . $task->id);
        $update->assertStatus(200);
        $update->assertJson(['payload' => !$task?->status]);
    }
}
