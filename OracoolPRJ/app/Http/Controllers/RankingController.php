<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RankingController extends Controller
{
    public function index()
    {
        $users=User::orderBy('points', 'desc')->get();

        return view('ranking', [
            'users' => $users,
        ]);
    }
    public function createAdmin()
    {
        return view('rankingAdmin');
    }
}
