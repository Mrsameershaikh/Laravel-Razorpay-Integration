<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\payment;
use Razorpay\Api\Api;
use Session;

class PaymentController extends Controller
{
    //razorpay key details
    //key id- rzp_test_KpdqgY3DYvB01n
    //key secret- cxjGYq5MWwJi9hLj0E2nSudq

    public function welcome()
    {
        return view('welcome');
    }

    public function success()
    {
        return view('success');
    }

    public function payment(Request $request)
    {
        $name = $request->input('name');
        $amount = $request->input('amount');

        $api = new Api('rzp_test_KpdqgY3DYvB01n', 'cxjGYq5MWwJi9hLj0E2nSudq');
        $order  = $api->order->create(array('receipt' => '123', 'amount' => $amount * 100 , 'currency' => 'INR')); 
        $orderId = $order['id']; 

        $user_pay = new Payment();
    
        $user_pay->name = $name;
        $user_pay->amount = $amount;
        $user_pay->payment_id = $orderId;
        $user_pay->save();

        $data = array(
            'order_id' => $orderId,
            'amount' => $amount
        );

        // Session::put('order_id', $orderId);
        // Session::put('amount' , $amount);
        return redirect()->route('welcome')->with('data',$data);
    }

       
    public function pay(Request $request){
        $data = $request->all();
        $user = Payment::where('payment_id', $data['razorpay_order_id'])->first();
        $user->payment_done = true;
        $user->razorpay_id = $data['razorpay_payment_id'];

        $api = new Api('rzp_test_KpdqgY3DYvB01n', 'cxjGYq5MWwJi9hLj0E2nSudq');
        

        try{
        $attributes = array(
             'razorpay_signature' => $data['razorpay_signature'],
             'razorpay_payment_id' => $data['razorpay_payment_id'],
             'razorpay_order_id' => $data['razorpay_order_id']
        );
        $order = $api->utility->verifyPaymentSignature($attributes);
        $success = true;
    }catch(SignatureVerificationError $e){

        $succes = false;
    }

        
    if($success){
        $user->save();
        return redirect('/success');
    }else{

        return redirect()->route('error');
    }

}
    public function error()
    {
        return view('error');
    }

    
}






      

       


