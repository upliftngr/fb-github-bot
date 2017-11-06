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
    		return "Post-WebHook Hooks up with facebook";
    	}else{
    		return "Get-WebHook Hooks up with facebook";
    	}

    	$webhook_token = env('WEBHOOK_TOKEN', 'webhook_token_default');
    }
}