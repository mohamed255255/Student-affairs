<?php
if(isset($_POST['birthdate'])) {
    // Input date from the birthdate field
    $birthdate = $_POST['birthdate'];

    // Format birthdate to match API requirement (MM-DD)
    $formattedDate = date("m-d", strtotime($birthdate));

    // Initialize cURL for fetching actors born on the same day
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://imdb8.p.rapidapi.com/actors/v2/get-born-today?today={$formattedDate}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: imdb8.p.rapidapi.com",
            "X-RapidAPI-Key:  cc6dc20e8dmsh2ba375255403d77p120154jsn8beb251186a3"
            /// 'cc6dc20e8dmsh2ba375255403d77p120154jsn8beb251186a3'
        ],
    ]);

    // Execute cURL request for fetching actors born on the same day
    $responseData = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    // Decode JSON response into PHP associative array
    $data = json_decode($responseData, true);

    if ($data != null && isset($data['data']['bornToday']['edges'])) {
        // Array to store actor names
        $actorNames = [];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: imdb8.p.rapidapi.com",
                "X-RapidAPI-Key: cc6dc20e8dmsh2ba375255403d77p120154jsn8beb251186a3"
            ],
        ]);

        // Loop through each actor in the response and fetch their bio to get names
        foreach ($data['data']['bornToday']['edges'] as $edge) {
            $actorId = $edge['node']['id'];

            // Initialize cURL for fetching actor bio
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://imdb8.p.rapidapi.com/actors/v2/get-bio?nconst={$actorId}",
            ]);
            // Execute cURL request for fetching actor bio
            $response = curl_exec($curl);
            $err = curl_error($curl);
            

            // Decode JSON response for actor bio
            $bioData = json_decode($response, true);

            if ($bioData !== null && isset($bioData['data']['name']['nameText']['text'])) {
                // Extract actor name and add it to the array
                $actorNames[] = $bioData['data']['name']['nameText']['text'];
            }
        }
        curl_close($curl);
        // Output the list of actor names
        if (!empty($actorNames)) {
            echo "<h2 style=\"padding:10px 10px 0\">Actors born on $formattedDate</h2>";
            foreach ($actorNames as $name) {
                echo "<li>$name</li>";
            }
        } else {
            echo "No actors found for the given date.";
        }
    } else {
        echo "Unable to fetch actor data.";
    }
}
?>