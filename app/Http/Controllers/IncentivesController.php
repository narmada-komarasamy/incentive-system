<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\IncentivesInterfaceModule;
//Include all needed files here

class IncentivesController extends Controller
{
	 /**
     * IncentivesInterfaceModule is a contract class for any incentive event implementation
     * @var IncentivesInterfaceModule
     */
	protected $incentivesIntefaceModule

	 public function __construct(IncentivesInterfaceModule $incentivesInterfaceModule) {
        $this->incentivesInterfaceModule = $incentivesInterfaceModule;
    }

     /**
     * Get Incentive events data for a user
     * @param array $params [parameters passed to the incentives API to create a ticket]
     * @return 
     */
    public function getUserData($params) {
    	list($status, $result) = $this->incentivesInterfaceModule->getUserData($params);
    	//TO-DO: Define status in a separate file that can read from here
        if ($status == SUCCESS) {
           	//To-Do: Transform data as needed to return to UI
            return $result;
        } else {
            return "Error message";
        }
    }

     /**
     * Add Incentive events data for a user
     * @param array $params [parameters passed to the incentives API to create a ticket]
     * @return 
     */
    public function addUserData($queryParameters) {
    	list($status, $result) = $this->incentivesInterfaceModule->addUserData($params);
    	//TO-DO: Define status in a separate file that can read from here
        if ($status == SUCCESS) {
           	//To-Do: Transform data as needed to return to UI
            return $result;
        } else {
            return "Error message";
        }
    }

     /**
     * Modify Incentive events data for a user
     * @param array $params [parameters passed to the incentives API to create a ticket]
     * @return 
     */
    public function modifyUserData($request) {
    	list($status, $result) = $this->incentivesInterfaceModule->modifyUserData($params);
    	//TO-DO: Define status in a separate file that can read from here
        if ($status == SUCCESS) {
           	//To-Do: Transform data as needed to return to UI
            return $result;
        } else {
            return "Error message";
        }
    }

     /**
     * Delete Incentive events data for a user
     * @param array $params [parameters passed to the incentives API to create a ticket]
     * @return 
     */
    public function deleteUserData($content) {
    	list($status, $result) = $this->incentivesInterfaceModule->deleteUserData($params);
    	//TO-DO: Define status in a separate file that can read from here
        if ($status == SUCCESS) {
           	//To-Do: Transform data as needed to return to UI
            return $result;
        } else {
            return "Error message";
        }
    }

}