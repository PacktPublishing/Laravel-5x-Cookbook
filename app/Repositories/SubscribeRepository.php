<?php

namespace App\Repositories;

use App\Plans;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SubscribeRepository
{
    public function registerUser($input, $level, $charge = false)
    {
        try {
            if($user = $this->existingUser($input, $level, $charge)) {
                return $user;
            } else {
                $user = $this->createNewCustomer($input, $level, $charge);
                return $user;
            }
        } catch (\Exception $e) {
            throw new \Exception(
                sprintf("Error subscribing user %s %s %d", $e->getMessage(), $e->getFile(), $e->getLine()));
        }
    }

    private function existingUser($input, $level, $charge)
    {
        /** @var \App\User $user */
        if($user = User::where("email", $input['stripeEmail'])->first()) {
            if($user->subscribed()) {
                $user = $this->chargeOrSwap($user, $charge, $level);
            } else {
                $user = $this->chargeOrSubscribe($user, $charge, $level, $input);
            }
            return $user;
        }
        return false;
    }

    private function createNewCustomer($input, $level, $charge)
    {
        $user = User::create(
            [
                'email' => $input['stripeEmail'],
                'password' => Hash::make(Str::random())
            ]
        );

        $user = $this->chargeOrSubscribe($user, $charge, $level, $input);

        return $user;
    }

    private function chargeOrSubscribe($user, $charge, $level, $input)
    {
        if($charge) {
            $user->charge($level);
        } else {
            $subscription = $user->newSubscription($level, $level);
            $subscription->create($input['stripeToken']);
        }
        return $user;
    }

    public function swap($current, $new_plan = false)
    {
        
        if($new_plan == false) {
            $new_plan = $this->getNewPlanFromCurrent($current);
        }
        
        $user = Auth::user();

        /** @var \App\User $user */
        $subscription = $user->subscription($current);

        return $subscription->swap($new_plan);
    }


    public function getNewPlanFromCurrent($current)
    {
        if($current == Plans::$LEVEL1) {
            return Plans::$LEVEL2;
        }
        
        return Plans::$LEVEL1;
    }

    /**
     * @param $user \App\User
     * @param $charge
     * @param $level
     * @return mixed
     */
    private function chargeOrSwap($user, $charge, $level)
    {
        if($charge)
        {
            $user->charge($level);
        } else {
            /**
             * @TODO fix this so we go from to on $level
             */
            $user->subscription($level)->swap($level);
        }

        return $user;
    }

}