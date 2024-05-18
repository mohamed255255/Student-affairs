<?php

namespace Tests\Unit\Http\Controllers;

use Tests\TestCase;
use App\Http\Controllers\CelebrityController;
use Illuminate\Http\Request;

class CelebrityBirthDateAPITest extends TestCase
{
    /** @test */
    public function returns_actor_names_for_given_birthdate()
    {
        $request = new Request([
            'birthdate' => '2000-05-16', // Example birthdate
        ]);

        $controller = new CelebrityController();

        $response = $controller->getCelebritiesByBirthdate($request);

        $this->assertEquals(200, $response->status());

    
    }
}
