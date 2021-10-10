<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProjectTest extends TestCase
{
    public function testListProjects()
    {
        $response = $this->json('GET', '/api/projects');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                'error',
                'payload' => [
                    [
                        'id',
                        'name',
                        'start',
                        'finish',
                        'created_at',
                        'updated_at',
                        'percent',
                        'deadline',
                    ]
                ]
            ]
        );
    }

    public function testCreateProject()
    {
        $data = [
            'name' => 'New Project',
            'start' => "2021-10-08",
            'finish' => '2021-10-10',
        ];

        $response = $this->json('POST', '/api/projects', $data);
        $response->assertStatus(201);
        $response->assertJson(['error' => false]);
        $response->assertJsonStructure(
            [
                'error',
                'payload' => [
                    'id',
                    'name',
                    'start',
                    'finish',
                    'created_at',
                    'updated_at',
                ]
            ]
        );
    }

    public function testDeleteProject()
    {
        $response = $this->json('GET', '/api/projects');
        $response->assertStatus(200);

        $project = $response->getData()->payload[0];

        $delete = $this->json('DELETE', '/api/projects/' . $project->id);
        $delete->assertStatus(200);
        $delete->assertJson(['payload' => true]);
    }
}
