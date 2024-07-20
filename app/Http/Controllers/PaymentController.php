<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payment');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_payment(Request $request)
    {
        $fields=[
            'name'=> 'required',
            'card_number' => 'required|max:19',
            'stripe_token' => '',
            'cvc' => 'required',
            'amount' => 'required',
            'expire_month' =>'required',
            'expire_year' => 'required'
        ];
            try{
                $total_amount = $fields['amount'] * 100;

                if($fields){
                    Stripe::setApiKey(env('STRIPE_SECRET'));
                    if(!empty($request->stripe_token)){
                        $charge= Charge::create([
                            'amount' => (int)abs($total_amount),
                            'currency' => 'USD',
                            'source' => $fields['stripe_token'],
                            'description' => 'the description is for the testing purpose',
                            'statement_descriptor' => 'Event ticket payment'
                        ]);
                        if(isset($charge->id)){

                        }else{
                            return 'Charge id invalid';
                        }
                    }else{
                        return 'StripeToken does Not Found';
                         }
                }else{
                    return 'Validation errors';
                }
            }catch (\Exception $e) {
                return $e->getMessage();
             }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
