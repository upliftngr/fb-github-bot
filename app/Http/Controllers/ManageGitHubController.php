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
		// $repos = GitHub::repo()->show('upliftngr', 'fb-github-bot');
		// $repos = GitHub::repo()->contributors('ornicar', 'php-github-api');
		// $repos = GitHub::repo()->contributors('upliftngr', 'fb-github-bot');
		// $repos = GitHub::user()->repositories('upliftngr');
		$all_repos = GitHub::user()->repositories('lightgh');
		echo "<h3>ALL - REPOS</h3>";
		dump($all_repos);
		/*foreach ($all_repos as $key => $each_repo) {
			echo "<h4>REPO: ({$each_repo['name']}) </h4>";
			dump((GitHub::repo()->contributors('lightgh', $each_repo['name'])));
		}*/
		// $repos = GitHub::repo()->contributors('lightgh', 'basicgit-class');
		// this example is simple, and there are far more methods available
		
		// $repos = GitHub::authorizations()->all();
		$repos = GitHub::connection('other')->authorizations()->all();
		dump($repos); 
		

    }
}
