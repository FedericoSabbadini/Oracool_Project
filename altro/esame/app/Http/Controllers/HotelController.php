<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class HotelController extends Controller
{
    public function show($id)
    {
        $dl = new DataLayer;
        $hotel = $dl->getHotelById($id);
        $reviews = $dl->getReviewsByHotelId($id);
        return view('hotel', [
            'hotel' => $hotel,
            'reviews' => $reviews,
        ]);
    }

    public function store(Request $request)
    {
        $dl = new DataLayer;
        $dl->storeReview($request);

        return redirect()->route('home')->with('success', 'Review creata con successo!');
    }
    
}
