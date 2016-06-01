<?php


namespace App\Http\Controllers;


use App\Plans;
use App\Repositories\SubscribeRepository;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class SubscribeController extends Controller
{
    /**
     * @var SubscribeRepository
     */
    private $subscribeRepository;

    public function __construct(SubscribeRepository $subscribeRepository)
    {
        $this->subscribeRepository = $subscribeRepository;
    }

    public function getLevelsPage()
    {
        $public_key = env('STRIPE_PUBLIC');
        return view('stripe.subscribe', compact('public_key'));
    }

    public function postLevel1()
    {
        $input = Input::all();

        if(empty($input['stripeToken']))
            return Redirect::back();

        $user = $this->subscribeRepository->registerUser($input, Plans::$LEVEL1);

        Auth::login($user);

        return Redirect::to('profile')->with("message", "Thanks!");
    }

    public function postLevel2()
    {
        $input = Input::all();
        
        if(empty($input['stripeToken']))
            return Redirect::back();

        $user = $this->subscribeRepository->registerUser($input, Plans::$LEVEL2);

        Auth::login($user);

        return Redirect::to('profile')->with("message", "Thanks!");
    }



    

}