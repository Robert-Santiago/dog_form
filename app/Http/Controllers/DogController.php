<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Import the Http facade

class DogController extends Controller
{
    public function produce_image() //kept da name
    {
        $breed = request()->query('breed'); // get da breed from da query parameter

        if ($breed) { // validate the bread to make sure it exists
            $response = Http::get("https://dog.ceo/api/breed/{$breed}/images/random"); // if the broad exists then fetch a random image of that bread

            
            if ($response->successful()) { // if bresd specific image fetching is successful
                $image_url = $response->json()['message'];

                return response()->json(['image_url' => $image_url]);
            }
        }

        // If no brood is selected or something goes wrong, fallback to a random dog image
        $response = Http::get('https://dog.ceo/api/breeds/image/random');

        
        if ($response->successful()) { // if the request is successful
            
            $image_url = $response->json()['message']; // extract the image URL from the API response

            
            return response()->json(['image_url' => $image_url]); // return the image URL as a JSON response
        }

        return response()->json(['error' => 'Unable to fetch dog image. Please try again later.'], 500); // if the request fails, return an error response
    }

    public function fetchBreeds() // function to fetch the list of all available berds
    {
        $response = Http::get('https://dog.ceo/api/breeds/list/all'); // send a GET request to the Dog CEO API to get all available breds
        
        
        if ($response->successful()) { // if the request is successful
            return response()->json(['breeds' => $response->json()['message']]); // return the list of brerds as a JSON response
        }

       return response()->json(['error' => 'Unable to fetch breed list. Please try again later.'], 500); // if the request fails, return an error response
    }
}