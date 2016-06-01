<?php

namespace App\Http\Controllers;

use App\Repositories\SubscribeRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class SubscriptionSwapController extends Controller
{

    public function swap(Request $request, SubscribeRepository $repository)
    {
        try {
            $repository->swap($request->input('current'), false);
            return redirect()->route('user.membership.show')->with('message', "Membership Swapped");
        } catch (\Exception $e)
        {
            return redirect()->route('user.membership.show')->withErrors("Could not swap membership");
        }
    }
}
