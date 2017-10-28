<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GitHub;

class ManageGitHubController extends Controller
{
	/**
	 * This method Connects to github
	 * @return  String
	 */
    public function connectToGitHub()
    {
    	echo "Test Method Call";

    	$org = GitHub::me()->organizations();
		// we're done here - how easy was that, it just works!

		// $repos = GitHub::repo()->show('upliftngr', 'Laravel-GitHub');
		$repos = GitHub::repo()->show('upliftngr', 'fb-github-bot');
		// this example is simple, and there are far more methods available
		
		dump($org, $repos); 
		

    }
}
