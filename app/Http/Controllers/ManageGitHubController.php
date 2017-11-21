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
    	
		$ansers_ = \Facades\App\Http\Controllers\ManageGitHubController::display('all');

    	foreach ($ansers_ as $a_repo) {
    		echo "<h4>".$a_repo."<h4>";
    	}

    }


    public function display($value='')
    {
    	if( strtolower($value) == 'listorg' || strtolower($value) == 'lo' ){
    		$org = GitHub::me()->organizations();
			$each_v = array();
			foreach ($org as $key => $value) {
				$each_v[] =  $value['login'];
			}
			return $each_v;
    	}

    	
    	/**
    	 * #TODO - Think of better appropriate name for this:
    	 * This is the list of my repo. Yet to be added to the list of commands
    	 * Currently List all the repositories of this individual
    	 */
    	if( strtolower($value) == 'listom' || strtolower($value) == 'lom' ){
    		$all_repos = GitHub::user()->repositories('lightgh');
			$each_v = array();
			$each_v[] = "Individual Repo: ";
			foreach ($all_repos as $value) {
				$each_v[] =  $value['full_name'];
			}
			return $each_v;
    	}

    	/**
    	 * List of account related repo such as organizations repo and 
    	 * individual repositories 
    	 */
    	if( strtolower($value) == 'list' || strtolower($value) == 'al' ){
    		$ansers_ = $this->display('listorg');

    		$each_v = array();

			foreach ($ansers_ as $value) {
				$each_v[] = "== Organization-Name: $value ==";
				$all_repos = GitHub::user()->repositories($value);

		    	foreach ($all_repos as $a_repo) {
		    		$each_v[] = $a_repo['full_name'];
		    	}
			}

    		$all_repos = GitHub::user()->repositories('lightgh');
			
			$each_v[] = "== By Individuals ==";
			foreach ($all_repos as $a_repo) {
    		 	$each_v[] = $a_repo['full_name'];
    		}

			return $each_v;
    	}

    	/**
    	 * List about 100 the repositories on github
    	 */
    	if( strtolower($value) == 'all' || strtolower($value) == 'al' ){
    		$all_repos = GitHub::repo()->all();

    		$each_v = array();

			foreach ($all_repos as $value) {
				$each_v[] = $value['full_name'];
			}

			return $each_v;
    	}
    }
}

