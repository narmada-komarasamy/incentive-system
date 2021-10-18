<?php

namespace Providers;

//Assume ServiceResponse and Database Models are set
use ../ServiceResponse;
use App/Models/User;
use App/Models/HealthRecord;


/**
 * This is implementation for the Incentive Event #1 ( User reporting birth)
 *
 */
class IncentiveEvent2Module extends IncentivesInterfaceModule
{

    public function __construct() {

    }

    /*
    * Get incentive data for userId. This will be data displayed
	* to the user when they open the incentives page to view their information.
    */
    public function getUserData($parameters) {
    	$userId = $parameters['userId'];
    	$userData = \DB::table('ovia_health_records AS ohr')
    	->join('ovia_event2_moods AS md', 'ohr.mood_id', '=', 'md.id')
    	->join('ovia_event2_symptms AS sm', 'ohr.symptom_id', '=', 'sm.id')
    	->select('md.description AS mood', 'sm.description AS symptom', 'ohr.date_created as Date')
    	->where('user_id', '=', $userId)
    	->get();
    	if(!empty($userData)) {
    		return $userData;
    	} else {
    		return new ServiceResponse(
                ServiceResponse::NOT_FOUND, [
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
    	$dateAdded = isset($parameters['date_added']) ? $parameters['date_added'] : '';
    	$moodId = isset($parameters['mood_id']) ? (int)$parameters['mood_id'] : null;
    	$symptomId = isset($parameters['symptom_id']) ? (int)$parameters['symptom_id'] : null;
    	//assume a model has been created for this table
    	$healthRecord = new HealthRecord;
    	$healthRecord->user_id = $userId;
    	$healthRecord->mood_id = $moodId;
    	$healthRecord->symptom_id = $symptomId;
    	$healthRecord->date_added = $dateAdded;
    	$healthRecord->save();

    	//return success or failure

    }


    public function getIncentiveInfo($content, $request);
	/*
    * Modify incentive data for userId. This will be data edited
	* by the user from the employer site.
    */
    public function modifyUserData($content, $request) {
    	$recordId = isset($parameters['recordId']) ? (int)$parameters['recordId'] : null;
    	$record = HealthRecord::find($recordId);
    	if(empty($record)) {
    		return new ServiceResponse(
                ServiceResponse::UNPROCESSABLE_ENTITY, [
                'error' => 'Missing details.'
                ]
            );
    	}

    	$dateAdded = isset($parameters['date_added']) ? $parameters['date_added'] : 
    				 $record['date_added'];
    	$mood = isset($parameters['mood_id']) ? $parameters['mood_id'] : $record['mood_id'];
    	$symptom = isset($parameters['symptom_id']) ? $parameters['symptom_id'] : $record['symptom_id'];
    	//assume a model has been created for this table
    	$healthRecord->user_id = $userId;
    	$healthRecord->gender = $gender;
    	$healthRecord->birthDate = $birthDate;
    	$healthRecord->hospital = $hospital;
    	$healthRecord->save();
    	//return success or failure

    }

    public function deleteUserData($content) {
    	$recordId = isset($parameters['recordId']) ? (int)$parameters['recordId'] : null;
    	$healthRecord = HealthRecord::find($recordId);
    	if(empty($healthRecord)) {
    		return new ServiceResponse(
                ServiceResponse::UNPROCESSABLE_ENTITY, [
                'error' => 'Missing details.'
                ]
            );
    	}

    	HealthRecord::where('id', '=', $recordId)->delete();
    	//return success or failure 
    }
}
