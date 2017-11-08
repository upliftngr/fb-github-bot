<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ManageMessengerController extends Controller
{
    function __construct()
    {
    	
    }


    // return "Get-WebHook Hooks to facebook";
    public function getWebhook(Request $request)
    {
    	Log::info('Get-WebHook: '. implode($request->input(), "  "));
    	$webhook_token = env('WEBHOOK_TOKEN', 'webhook_token_default');

    	$hub_mode = $request->input('hub_mode');
    	$hub_challenge = $request->input('hub_challenge');
    	$hub_verify_token = $request->input('hub_verify_token');
    		
    	if($hub_mode === 'subscribe' && $hub_verify_token === $webhook_token){
    		return $hub_challenge;
    	}
    		
    		#TODO - return a view with the status 403
    		// abort(403, 'Unauthorized action.');

    }

    // handle post webhook requests
    public function postWebhook(Request $request)
    {

    	Log::info('Post-WebHook: '. implode($request->input(), "  " ));
    	return "YEAHHH";
    }


    // Handles messages events
    // sender_psid, received_message
	function handleMessage(Request $request) {

	}

	// Handles messaging_postbacks events
	// sender_psid, received_postback
	function handlePostback(Request $request) {

	}

	// Sends response messages via the Send API
	// sender_psid, response
	function callSendAPI(Request $request) {
	  
	}

}