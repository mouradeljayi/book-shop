<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;

class PaypalPaymentController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function handlePayment()
    {
      $data = [];
      $data['items'] = [];

      foreach(Cart::content() as $item)
      {
        array_push($data['items'], [
          'name' => $item->name,
          'price' => $item->price,
          'desc' => $item->model->description,
          'qty' => $item->qty
        ]);
      }

      $data['invoice_id'] = auth()->user()->id;
      $data['invoice_description'] = "Order #{$data['invoice_id']}";
      $data['return_url'] = route('success.payment');
      $data['cancel_url'] = route('cancel.payment');

      $total = 0;
      foreach($data['items'] as $item) {
          $total += $item['price']*$item['qty'];
      }

      $data['total'] = $total;
      $paypalModule = new ExpressCheckout;

      $response = $paypalModule->setExpressCheckout($data);
      $response = $paypalModule->setExpressCheckout($data, true);

      return redirect($response['paypal_link']);
    }

    public function paymentCancel()
    {
      return redirect()->route('cart.index')->with('info', 'You have canceled the payment operation');
    }

    public function paymentSuccess(Request $request)
    {
      $paypalModule = new ExpressCheckout;
      $response = $paypalModule->getExpressCheckoutDetails($request->token);

      if(in_array(strtoupper($response['ACK']),['SUCCESS', 'SUCCESSWITHWARNING']))
      {
        foreach (Cart::content() as $item)
        {
          Order::create([
            'user_id' => auth()->user()->id,
            'book_title' => $item->name,
            'qty' => $item->qty,
            'price' => $item->price,
            'total' => $item->price * $item->qty,
            'paid' => 1,
          ]);
          Cart::destroy();
        }
        return redirect()->route('cart.index')->with('success', 'The payment is completed successfully');
      }
    }
}
