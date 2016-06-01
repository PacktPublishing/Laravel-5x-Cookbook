<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class StripeQuantifyBuyController extends Controller
{
    public function postQuantity()
    {
        $input = Input::all();

        if(empty($input['stripeToken']))
            return Redirect::back();

        $user = $this->makeOrGetUser($input['stripeEmail']);

        $this->setStripe();

        if($user->stripe_id)
        {
            $this->chargeUser($user->stripe_id);
        }
        else
        {
            $customer = $this->createStripeCustomer($input);
            $user->stripe_id = $customer->id;
            $user->save();

            $this->chargeUser($user->stripe_id);
        }

        Auth::login($user);

        return Redirect::to('profile')->with("message", "Thanks!");
    }

    private function makeOrGetUser($email)
    {
        if($user = User::where("email", $email)->first())
        {
            return $user;
        }

        $user = User::create(
            [
                'email' => $email,
                'password' => Hash::make(Str::random())
            ]
        );

        return $user;
    }

    private function setStripe()
    {
        $stripe = array(
            'secret_key'      => env('STRIPE_API_SECRET'),
            'publishable_key' => env('STRIPE_PUBLIC')
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);
    }

    private function chargeUser($stripe_id)
    {
        \Stripe\Charge::create(
            [
                'customer'     => $stripe_id,
                'amount'   => 22500,
                'currency' => 'usd',
                'description' => 'ICDB Membership'
            ]
        );
    }

    private function createStripeCustomer($input)
    {
        $customer = \Stripe\Customer::create(array(
            'source'     => $input['stripeToken'],
            'email'    => $input['stripeEmail']
        ));

        return $customer;
    }
}
