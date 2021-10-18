<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

/*
* This class is to interface with available incentive events in Ovia Incentives System.
*/

class OviaGlobalIncentivesController extends Controller
{

	public function __construct() {
    }

    /*
    * Get all available incentives from Ovia incentives system
    */
    public function getAllEvents() {
        $allEvents = \DB::table('ovia_incentives')
        ->select('id', 'title', 'description', 'date_created')
        ->get();
        if(!empty($allEvents)) {
            return $allEvents;
        } else {
            return new ServiceResponse(
                ServiceResponse::UNPROCESSABLE_ENTITY, [
                'error' => 'Missing details'
                ]
            );
        }
    }

    /*
    * Get employer specific incentives from Ovia incentives system.
    * Assumption: For the Employers Admin page
    */ 
    public function getEventsByEmployerId($queryParameters) {
    	$emplId = $parameters['employerId'];
        $employerEvents = \DB::table('ovia_incentives AS oic')
        ->join('ovia_employer_incentives AS ei', 'ei.incentive_id', '=', 'oic.id')
        ->select('id', 'title', 'description', 'date_created')
        ->where('ei.employer_id', '=', $emplId)
        ->get();
        if(!empty($employerEvents)) {
            return $employerEvents;
        } else {
            return new ServiceResponse(
                ServiceResponse::UNPROCESSABLE_ENTITY, [
                'error' => 'Missing user details'
                ]
            );
        }
    }

    /*
    * Get user specific incentives from Ovia incentives system.
    * Assumption: For the Users Incentives Page
    */ 
    public function getEventsByEmployerId($queryParameters) {
        $usrId = $parameters['userId'];
        $userEvents = \DB::table('ovia_incentives AS oic')
        ->join('ovia_user_incentives AS ui', 'ui.incentive_id', '=', 'oic.id')
        ->select('id', 'title', 'description', 'date_created')
        ->where('ui.user_id', '=', $usrId)
        ->get();
        if(!empty($userEvents)) {
            return $userEvents;
        } else {
            return new ServiceResponse(
                ServiceResponse::UNPROCESSABLE_ENTITY, [
                'error' => 'Missing user details'
                ]
            );
        }
    }

    //Add more endpoints as needed

}