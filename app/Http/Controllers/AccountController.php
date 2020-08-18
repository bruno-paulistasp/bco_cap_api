<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
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

    public function balance(Request $request)
    {
    	$user = $request->user(); 
    	
    	return response()->json([
    		'balance' => $user->balance,
    	]);
    }

    public function deposit(Request $request)
    {
    	$user = $request->user();

    	if(!$request->amount){
    		return response()->json([
    			'message' => 'Nao foi enviado nenhum valor'
    		], 422);
    	}

		if(!is_numeric($request->amount)){
    		return response()->json([
    			'message' => 'O valor esta incorreto'
    		], 422);
    	}

		if($request->amount <= 0){
    		return response()->json([
    			'message' => 'O valor esta incorreto'
    		], 422);
    	}

    	$user->balance += $request->amount;
    	$user->save();
    	
    	return response()->json([
    		'agency' => $user->agency,
    		'account' => $user->account,
    		'name' => $user->name,
    		'balance' => $user->balance,
    	]);
    }

    public function takeOut(Request $request)
    {
    	$user = $request->user(); 

    	if(!$request->amount){
    		return response()->json([
    			'message' => 'Nao foi enviado nenhum valor'
    		], 422);
    	}

		if(!is_numeric($request->amount)){
    		return response()->json([
    			'message' => 'O valor esta incorreto'
    		], 422);
    	}

		if($request->amount <= 0){
    		return response()->json([
    			'message' => 'O valor esta incorreto'
    		], 422);
    	}

		if($user->balance < $request->amount){
    		return response()->json([
    			'message' => 'Nao ha saldo suficiente'
    		], 422);
    	}

    	$user->balance -= $request->amount;
    	$user->save();
    	
    	return response()->json([
    		'agency' => $user->agency,
    		'account' => $user->account,
    		'name' => $user->name,
    		'balance' => $user->balance,
    	]);
    }
}
