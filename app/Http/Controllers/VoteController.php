<?php

namespace App\Http\Controllers;

use App\User;
use App\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $user = User::where('id', $request->id_user)->update(['vote' => true]);

        $vote = Vote::updateOrCreate(['id' => $request->id_user],$request->all());

        return response()->json([
            'vote' => $user,
            'data' => $vote
        ]);
    }

    public function count()
    {
        $vote1 = Vote::where('id_candidat', 1)->count();
        $vote2 = Vote::where('id_candidat', 2)->count();

        return response()->json([
            'number 1' => $vote1,
            'number 2' => $vote2,
        ]);
    }
}
