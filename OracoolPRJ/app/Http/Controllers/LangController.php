<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LangController extends Controller
{
    public function edit(Request $request, $lang)
    {
        session()->put('language', $lang);
        return redirect()->back();
    }


    public function setTimezone(Request $request)
    {
        
        $timezone = $request->input('timezone');

        if ($timezone) {
            session()->put('timezone', $timezone);
            return response()->json(['message' => "Timezone set successfully, $timezone"]);
        } else {
            return response()->json(['message' => 'Timezone not provided'], 400);
        }
        
    }
}
