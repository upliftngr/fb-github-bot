<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageMessengerController extends Controller
{
    function __construct()
    {
    	
    }


    public function webhook(Request $request)
    {
    	if ($request->isMethod('post')) {
    		return env('GITHUB_VALIDATE_POST');
    		// return "Post-WebHook Hooks up with facebook";
    	}else{
    		$verify_token = env('GITHUB_VALIDATE_GET');
    		// if()
    		dd($request->all());

    		// return "Get-WebHook Hooks up with facebook";
    	}

    	$webhook_token = env('WEBHOOK_TOKEN', 'webhook_token_default');
    }
}