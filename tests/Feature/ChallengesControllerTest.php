<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\V1\ChallengesController;
use App\Http\Resources\V1\ChallengesResource;
use App\Models\Challenges;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TestCase;

class ChallengesControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testIndexReturnsChallengesResourceCollection()
    {
        //Arrange
        $request = new Request(['page' => 1, 'items' => 10]);
        $controller = new ChallengesController();

        //Act
        $response = $controller->index($request);

        $data = $response->toArray($request);

        // // Assert
        // $response->assertStatus(200)
        //     ->assertJsonCount(9, 'data');
    }
}
