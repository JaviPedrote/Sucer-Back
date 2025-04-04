<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class AnuncioController extends Controller
{
    public function index()
    {
        return response()->json(['mensaje' => 'Funciona Sucer']);
    }
}
