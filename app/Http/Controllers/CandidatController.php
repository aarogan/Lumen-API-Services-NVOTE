<?php

namespace App\Http\Controllers;

use App\Candidat;

class CandidatController extends Controller
{
    public function index()
    {
        $candidat = Candidat::all();
        return response()->json($candidat);
    }
}
