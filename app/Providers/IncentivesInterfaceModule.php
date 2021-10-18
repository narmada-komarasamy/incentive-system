<?php

namespace Providers;

/**
 * This abstract class is the base used by all incentives interface
 * implementations.  It provides common methods used to interface with
 * each incentive program.
 */
abstract class IncentivesInterfaceModule
{

    public function __construct() {

    }

    abstract public function getUserData($queryParameters);

    abstract public function addUserData($queryParameters);

    abstract public function modifyUserData($queryParameters);

    abstract public function deleteUserData($queryParameters);
}
