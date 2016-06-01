<?php


namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Stripe\Customer;

class ProfileController extends Controller
{
    /**
     * @var Guard
     */
    private $auth;

    public function __construct(Guard $auth)
    {

        $this->auth = $auth;
    }

    public function getUser()
    {
        
        $user = $this->auth->user();

        $subscriptions = $user->subscriptions->toArray();

        $invoices = $user->invoices();
     
        $onetime_purchase = [];
        /**
         * Get other Purchases put logic in model
         */
        $stripe = array(
            'secret_key'      => env('STRIPE_SECRET'),
            'publishable_key' => env('STRIPE_PUBLIC')
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);

        if($user->stripe_id)
        {
            $onetime_purchase = $this->loadCustomerOneTimePurchases($user);
        }

        return view('profile.user', compact('user', 'invoices', 'onetime_purchase', 'subscriptions'));
    }

    public function postEdit()
    {
        $user = $this->auth->user();

        $input = Input::all();

        if(!empty($input['password']) && !empty($input['password_confirmation']))
        {
            $validation =  Validator::make($input, [
                'email' => 'required|email|max:255',
                'password' => 'required|confirmed|min:6',
            ]);

            if($validation->fails())
            {
                return redirect('profile')
                    ->withErrors($validation)
                    ->withInput();
            }

            $user->password = bcrypt($input['password']);
        }

        if($user->email != $input['email'])
        {
            $validation =  Validator::make($input, [
                'email' => 'email|max:255|unique:users'
            ]);

            if($validation->fails())
            {
                return redirect('profile')
                    ->withErrors($validation)
                    ->withInput();
            }

            $user->email = $input['email'];
        }

        $user->save();

        return redirect('profile')
            ->withMessage("Profile Updated");
    }

    public function getPrintInvoice($invoiceId)
    {
        return $this->auth->user()->downloadInvoice($invoiceId, [
            'vendor'  => 'ICDB',
            'product' => 'Subscriptions',
        ]);
    }

    public function getCancel()
    {
        $user = $this->auth->user();

        $user->subscription()->cancel();

        return redirect('profile')
            ->withMessage("Sorry to see you go :(");
    }

    private function transform($onetime_purchase)
    {
        $transformed = [];
        foreach($onetime_purchase->data as $key => $value)
        {
            $value = $value->__toArray();

            if($value['description'] == 'ICDB')
            {
                $value['created']   = Carbon::createFromTimestamp($value['created']);
                $value['amount']    = money_format('$%i', $value['amount'] / 100);
                $value['status']    = ucfirst($value['status']);

                $transformed[] = $value;
            }
        }

        return $transformed;
    }

    public function loadCustomerOneTimePurchases($user)
    {
        $customer = new Customer();
        $onetime_purchase  = $customer->retrieve($user->stripe_id)->charges();
        $onetime_purchase  = $this->transform($onetime_purchase);

        return $onetime_purchase;
    }
}