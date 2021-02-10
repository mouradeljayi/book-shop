<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;
use App\Models\Order;
use App\Models\Category;



class AdminController extends Controller
{
   public function __construct()
   {
     $this->middleware('auth:admin')->except(['adminLoginForm', 'adminLogin']);
   }


    public function index()
    {
      return view('admin.index', ['books' => Book::all(), 'orders' => Order::all(), 'categories' => Category::all()]);
    }

    public function adminLoginForm()
    {
      return view('admin.auth.login');
    }

    public function adminLogin(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'email' => 'required',
        'password' => 'required'
      ]);

      if($validator->fails())
      {
        return redirect('admin/login')->withErrors($validator)
                                      ->withInput();
      }

      if(auth()->guard('admin')->attempt([
        'email' => $request->email,
        'password' => $request->password
      ], $request->get('remember')))
      {
        return redirect('/admin');
      }
      else
      {
        return redirect()->route('admin.login')->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);
      }
    }

    public function adminLogout()
    {
      auth()->guard('admin')->logout();
      return redirect()->route('admin.login');
    }
}
