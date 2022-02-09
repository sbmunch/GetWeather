<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Throwable;

class getWeatherController extends Controller
{
    //

    public function getWeather(Request $request)
    {
        try {
        $CVR = $request->get('cvr');

        //Get location from CVRAPI
        
        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,'https://cvrapi.dk/api?search=' . $CVR . '&country=dk');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_USERAGENT,'project');

        $response = curl_exec($ch);
        curl_close($ch);

        $location = json_decode($response)->cityname;

        //Get weather from EUAPI
        
        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,'https://vejr.eu/api.php?location=' . $location . '&degree=C');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_USERAGENT,'project');

        $response = curl_exec($ch);
        curl_close($ch);

        return response()->json([
            'success' => true,
            'data' => json_decode($response)->CurrentData,
        ], 200);

    } catch (Throwable $exception) {

        throw $exception; // let the laravel handler take care of it

        //alternative to handler:

        //return response()->json([
        //    'success' => false,
        //    'exception' => $exception,
        //], 500);

    }

    }
}
