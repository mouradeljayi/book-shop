<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivateYourAccount;
use App\Models\User;

class ActivationController extends Controller
{
  // Activate account
    public function activateUserAccount($code)
    {
    	$user = User::whereCode($code)->first();
    	$user->code = null;
    	$user->update([
    		"active" => 1
    	]);
      Auth::login($user);

      return redirect('/')->withSuccess("logged in");
    }

    // Send E-mail to activate user account
    public function resendActivationCode($email)
    {
      $user = User::whereEmail($email)->first();
      if($user->active)
      {
        return redirect('/');
      }

      Mail::to($user)->send(new ActivateYourAccount($user->code));
      return redirect('/login')->withSuccess("Activation link is sent");
    }
}
