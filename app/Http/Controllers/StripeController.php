<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use FFI\Exception;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use Stripe\Charge;
use Stripe\Checkout\Session;
use Stripe\Stripe;


class StripeController extends Controller
{
    public function index()
    {
        return view('stripe');
    }
    public function stripe()
    {
        return view('stripe1');
    }
    public function payStripe(Request $request)
    {
        
        $this->validate($request, [
            'card_no' => 'required',
            'expiry_month' => 'required',
            'expiry_year' => 'required',
            'cvv' => 'required',
        ]);
 
        $stripe = \Stripe\Stripe::setApiKey("sk_test_51K8gvTH1Kv1XTgAUjWNeI37mU0vjv9GIlpjhCcN8NRpXZH3B8e4ZProiqSDsYPAcWOGPPOh68yBvjXKZSUmE8S3j005Yd48q6f");
        
        try {
            $response = \Stripe\Token::create(array(
                "card" => array(
                    "number"    => $request->input('card_no'),
                    "exp_month" => $request->input('expiry_month'),
                    "exp_year"  => $request->input('expiry_year'),
                    "cvc"       => $request->input('cvv')
                )));
            if (!isset($response['id'])) {
                return redirect()->route('addmoney.paymentstripe');
            }
            $charge = \Stripe\Charge::create([
                'card' => $response['id'],
                'currency' => 'USD',
                'amount' =>  100 * 100,
                'description' => 'wallet',
            ]);
 
            if($charge['status'] == 'succeeded') {
                return redirect('stripe1')->with('success', 'Payment Success!');
 
            } else {
                return redirect('stripe1')->with('error', 'something went to wrong.');
            }
 
        }
        catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function makePayment(Request $request)
    {
        // dd($request->all());
        Stripe::setApiKey(env('STRIPE_SECRET'));
        Charge::create ([
                "amount" => 120 * 100,
                "currency" => "inr",
                "source" => $request->stripeToken,
                "description" => "Make payment and chill." 
        ]);
        $value="payment successfully made";

      $request->session()->flash('success', $value);
        return back();
    }
}
