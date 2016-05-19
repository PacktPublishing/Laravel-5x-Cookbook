<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class FavoriteRemove extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function remove(Request $request, $id)
    {
        $fav = $fav = Favorite::find($id);

        if (Gate::denies('delete', $fav)) {
            return Response::json(['data' => null, 'message' => "Error You do not own this Favorite"], 403);
        }
        
        if ($fav && $fav->user_id == Auth::user()->id) {
            $fav->delete();
            return Response::json(['data' => null, 'message' => "Favorite Deleted"], 200);
        }

        return Response::json(['data' => null, 'message' => "Error deleting Favorite"], 304);
    }
}
