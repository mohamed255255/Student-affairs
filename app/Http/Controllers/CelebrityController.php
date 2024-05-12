<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CelebrityController extends Controller
{
    public function getCelebritiesByBirthdate(Request $request)
    {
        // Validate the request
        $request->validate([
            'birthdate' => 'required|date',
        ]);

        // Format birthdate to match API requirement (MM-DD)
        $formattedDate = date("m-d", strtotime($request->birthdate));

        // Make API request to IMDb API
        $response = Http::withHeaders([
            'X-RapidAPI-Host' => 'imdb8.p.rapidapi.com',
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
        ])->get("https://imdb8.p.rapidapi.com/actors/v2/get-born-today", [
            'today' => $formattedDate,
        ]);

        // Process API response
        $actorNames = [];
        $data = $response->json();

        if (isset($data['data']['bornToday']['edges'])) {
            foreach ($data['data']['bornToday']['edges'] as $edge) {
                $actorId = $edge['node']['id'];

                // Make another API request to get actor bio
                $bioResponse = Http::withHeaders([
                    'X-RapidAPI-Host' => 'imdb8.p.rapidapi.com',
                    'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
                ])->get("https://imdb8.p.rapidapi.com/actors/v2/get-bio", [
                    'nconst' => $actorId,
                ]);

                $bioData = $bioResponse->json();

                if (isset($bioData['data']['name']['nameText']['text'])) {
                    $actorNames[] = $bioData['data']['name']['nameText']['text'];
                }
            }
        }

        return response()->json(['actorNames' => $actorNames]);
    }
}
