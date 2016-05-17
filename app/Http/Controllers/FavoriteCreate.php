<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class FavoriteCreate extends Controller
{
    public function create(Request $request)
    {
        $comic = $request->input('comic');

        $favorite = Favorite::create(
            [
                'comic' => $comic
            ]
        );

        $favorite->user_id = Auth::user()->id;

        $favorite->save();

        return Response::json(['data' => $favorite->toArray(), 'message' => "Favorite Added"], 201);
    }
}
