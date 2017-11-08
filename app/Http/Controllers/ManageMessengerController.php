<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageMessengerController extends Controller
{
    function __construct()
    {
    	
    }


    // return "Get-WebHook Hooks to facebook";
    public function webhook(Request $request)
    {
    	$webhook_token = env('WEBHOOK_TOKEN', 'webhook_token_default');

    	if ($request->isMethod('post')) {
    		return "Post-WebHook Hooks up with facebook";
    	}else{

    		$hub_mode = $request->input('hub_mode');
    		$hub_challenge = $request->input('hub_challenge');
    		$hub_verify_token = $request->input('hub_verify_token');
    		
    		if($hub_mode === 'subscribe' && $hub_verify_token === $webhook_token){
    			return $hub_challenge;
    		}
    		
    		#TODO - return a view with the status 
    		return response('Unauthorized action.', 403);

    	}

    }
}