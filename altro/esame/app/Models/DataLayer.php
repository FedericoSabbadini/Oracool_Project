<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hotel;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;


class DataLayer extends Model
{

    public function getHotel() {
        return Hotel::all();
    }

    public function getHotelById($id) {
        return Hotel::find($id);
    }

    public function getReviewsByHotelId($hotelId) {
        $reviews = Hotel::find($hotelId)->reviews;
        
        foreach ($reviews as $review) {
            $user = $review->user;
            $review->user = $user->name;
        }

        return $reviews;
    }

    public function storeReview($request) {
        $hotel = Hotel::find($request->input('hotel_id'));
        $review = new Review();
        $review->user_id = Auth::id();
        $review->hotel_id = $hotel->id;
        $review->punteggio = $request->input('punteggio');
        $review->commento = $request->input('commento');
        $review->save();
    }
}