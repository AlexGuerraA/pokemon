<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class pokemonController extends Controller
{
    public function getpokemon(){
        $response = Http::get('https://pokeapi.co/api/v2/generation/1/');
        $resultado = json_decode($response->body());
        $data['pokemons']= $resultado->pokemon_species;
        // dd($data['pokemons']);      
        return view('welcome', $data);
     }
}
