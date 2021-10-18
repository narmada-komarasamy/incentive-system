<?php

namespace Providers;

//Assume ServiceResponse and Database Models are set
use ../ServiceResponse;
use App/Models/User;
use App/Models/BirthRecord;


/**
 * This is implementation for the Incentive Event #1 ( User reporting birth)
 *
 */
class IncentiveEvent1Module extends IncentivesInterfaceModule
{

    public function __construct() {

    }

    /*
    * Get incentive data for userId. This will be data displayed
	* to the user when they open the incentives page to view their information.
    */
    public function getUserData($parameters) {
    	$userId = $parameters['userId'];
    	$userData = \DB::table('ovia_birth_records')
    	->select('birth_date', 'gender', 'hospital')
    	->where('user_id', '=', $userId)
    	->get();
    	if(!empty($userData)) {
    		return $userData;
    	} else {
    		return new ServiceResponse(
                ServiceResponse::UNPROCESSABLE_ENTITY, [
                'error' => 'Missing user details'
                ]
            );
    	}
    }

    /*
    * Add incentive data for userId. This will be data entered
	* by the user from the employer site.
    */
    public function addUserData($parameters) {
    	$userId = isset($parameters['userId']) ? (int)$parameters['userId'] : null;

    	if(empty($userId)) {
    		return new ServiceResponse(
                ServiceResponse::UNPROCESSABLE_ENTITY, [
                'error' => 'Missing user Id. Cannot add user data'
                ]
            );
    	}
    	$birthDate = isset($parameters['birth_date']) ? $parameters['birth_date'] : '';
    	$gender = isset($parameters['gender']) ? $parameters['gender'] : '';
    	$hospital = isset($parameters['hospital']) ? $parameters['hospital'] : '';
    	//assume a model has been created for this table
    	$birthRecord = new BirthRecord;
    	$birthRecord->user_id = $userId;
    	$birthRecord->gender = $gender;
    	$birthRecord->birthDate = $birthDate;
    	$birthRecord->hospital = $hospital;
    	$birthRecord->save();

    	//return success or failure

    }


    public function getIncentiveInfo($content, $request);
	/*
    * Modify incentive data for userId. This will be data edited
	* by the user from the employer site.
    */
    public function modifyUserData($content, $request) {
        $recordId = isset($parameters['recordId']) ? (int)$parameters['recordId'] : null;
    	$userId = isset($parameters['userId']) ? (int)$parameters['userId'] : null;	
    	$user = User::find($userId);
    	if(empty($user)) {
    		return new ServiceResponse(
                ServiceResponse::UNPROCESSABLE_ENTITY, [
                'error' => 'Missing user details.'
                ]
            );
    	}

    	$birthDate = isset($parameters['birth_date']) ? $parameters['birth_date'] : 
    				 $user['birthDate'];
    	$gender = isset($parameters['gender']) ? $parameters['gender'] : $user['gender'];
    	$hospital = isset($parameters['hospital']) ? $parameters['hospital'] :
    			    $user['hospital'] ;
    	//assume a model has been created for this table
        $birthRecord = BirthRecord::find($recordId);
    	$birthRecord->user_id = $userId;
    	$birthRecord->gender = $gender;
    	$birthRecord->birthDate = $birthDate;
    	$birthRecord->hospital = $hospital;
    	$birthRecord->save();
    	//return success or failure 

    }

    public function deleteUserData($content) {
    	$userId = isset($parameters['userId']) ? (int)$parameters['userId'] : null;
    	$user = User::find($userId);
    	if(empty($user)) {
    		return new ServiceResponse(
                ServiceResponse::UNPROCESSABLE_ENTITY, [
                'error' => 'Missing user details.'
                ]
            );
    	}

    	BirthRecord::where('user_id', '=', $userId)->delete();
    	//return success or failure 
    }
}
