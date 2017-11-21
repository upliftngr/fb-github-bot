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
    	
		$ansers_ = \Facades\App\Http\Controllers\ManageGitHubController::display('list');

    	foreach ($ansers_ as $a_repo) {
    		//echo "<h4>".$a_repo."<h4>";
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

    	if( strtolower($value) == 'list' || strtolower($value) == 'l' ){
    		$all_repos = GitHub::user()->repositories('lightgh');
			$each_v = array();
			$each_v[] = "Individual Repo: ";
			foreach ($all_repos as $value) {
				$each_v[] =  $value['full_name'];
			}
			return $each_v;
    	}

    	if( strtolower($value) == 'all' || strtolower($value) == 'al' ){
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
    }
}

