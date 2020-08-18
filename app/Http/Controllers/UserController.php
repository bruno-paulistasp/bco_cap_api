<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	/**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function me(Request $request)
    {
    	$user = $request->user(); 
    	
    	return response()->json([
    		'agency' => $user->agency,
    		'account' => $user->account,
    		'name' => $user->name,
    		'balance' => $user->balance,
    	]);
    }
}
