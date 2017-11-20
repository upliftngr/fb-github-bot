<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

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
    		echo $hub_challenge;
    	}else{
    	   throw new Exception("Tokken not verified");
        }

    	// return view('welcome');

    }

    // handle post webhook requests
    public function postWebhook(Request $request)
    {

        // Log::info('Post-WebHook: '. implode($request->input(), "  " ));
    	Log::info('Post-WebHook: ----- |:  '. print_r($request->input('entry'), true ) );

    	// $input = json_decode(file_get_contents('php://input'), true);

        // $input =  $request->json()->all(); //read json in request
        $input =   $request->input(); //read json in request

        // var_dump($input);
        //return response()->json($data); 
         // "hiiii";
         // die("jj");
         
        $message = $this->readMessage($input);
        $textmessage = $this->sendMessage($message);

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

	public function checkWebHook(Request $request)
	{
		    	$client = new Client();
    		
	}

    public function readMessage($input)
    {
      try{
           $payloads = null;
           $senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
           $messageText = $input['entry'][0]['messaging'][0]['message']['text'];
           $postback = '';
           $postback = isset($input['entry'][0]['messaging'][0]['postback'])? $input['entry'][0]['messaging'][0]['postback'] : '';
           $loctitle = isset($input['entry'][0]['messaging'][0]['message']['attachments'][0]['title'])? $input['entry'][0]['messaging'][0]['message']['attachments'][0]['title'] : '' ;
           if (!empty($postback)) {
            $payloads = $input['entry'][0]['messaging'][0]['postback']['payload'];
            return ['senderid' => $senderId, 'message' => $payloads];
           }

           if (!empty($loctitle)) {
            $payloads = $input['entry'][0]['messaging'][0]['postback']['payload'];
            return ['senderid' => $senderId, 'message' => $messageText, 'location' => $loctitle];
           }

           // var_dump($senderId,$messageText,$payload);
           //   $payload_txt = $input['entry'][0]['messaging'][0]['message']['quick_reply']‌​['payload'];

           return ['senderid' => $senderId, 'message' => $messageText];
        }catch(Exception $ex) {
            return $ex->getMessage();
      }
    }

    public function sendMessage($input)
    {
        $accessToken = env('PAGE_ACCESS_TOKEN', 'page_token_default');

      try {
       $client = new Client();
       // $url = "https://graph.facebook.com/v2.6/me/messages";
       $url = "https://graph.facebook.com/v2.10/me/messages";
       $messageText = strtolower($input['message']);
       $senderId = $input['senderid'];
       $msgarray = explode(' ', $messageText);
       $response = null;
       $header = array(
        'content-type' => 'application/json'
       );
       if (in_array('hi', $msgarray)) {
            $answer = "Hello! how may I help you today?";
            $response = ['recipient' => ['id' => $senderId], 'message' => ['text' => $answer], 'access_token' => $accessToken];
         }
         elseif ($messageText == 'get started') {
            $answer = [
            "text" => "Please share your location:", 
            "quick_replies" => [
            [
            "content_type" => "location", 
            ]
            ]];
            $response = [
            'recipient' => ['id' => $senderId], 
            'message' => $answer, 
            'access_token' => $accessToken
            ];
        }
       elseif (!empty($input['location'])) {
        $answer = ["text" => 'great you are at' . $input['location'], ];
        $response = ['recipient' => ['id' => $senderId], 'message' => $answer, 'access_token' => $accessToken];
       }elseif($messageText == 'help'){
        $answer = 'list - to list repo\nrecent - to list recent repo\nstatus - to get your account status.';
        $response = ['recipient' => ['id' => $senderId], 'message' => ['text' => $answer], 'access_token' => $accessToken];
       }
       elseif (!empty($messageText)) {
        $answer = 'I can not Understand you ask me about blogs';
        $response = ['recipient' => ['id' => $senderId], 'message' => ['text' => $answer], 'access_token' => $accessToken];
       }

       $response = $client->post($url, ['query' => $response, 'headers' => $header]);

       return true;
      }

      catch(RequestException $e) {
       $response = json_decode($e->getResponse()->getBody(true)->getContents());
       file_put_contents("test.json", json_encode($response));
       return $response;
      }
    }

}