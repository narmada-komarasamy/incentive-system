<?php
namespace Providers;

class IncentivesInterfaceManager
{
	public function __construct() {}

	function init(string modulePath) {
		//initialize ticketinginterfacemanager class
		//detect available ticketing interface modules
		//setting up internal constructs
		//module path -- relative path where modules can be found 
		//return boolean
	}

	function getAllIncentivePrograms() {
		//Returns array of all available incentives programmes from Ovia
		
	}

	function getIncentiveProgramsByEmployerId() {
		//Returns incentives programmes for a specific employer

	}

	function CreateIncentivesInterfaceModule(string id, TicketingSystemParameters parms) {
		//Create a new Ovia incentive program

	}
}