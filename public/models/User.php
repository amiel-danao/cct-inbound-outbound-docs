<?php
class User {
  public $id;
  public $username;
  public $firstName;
  public $middleName;
  public $lastName;
  public $contactNumber;
  public $userType;
  public $lastLogin;
  public $active;

  public function __construct($id, $username, $firstName, $middleName, $lastName, $contactNumber, $userType, $lastLogin, $active) {

    $this->id = $id;
    $this->username = $username;
    $this->firstName = $firstName;
    $this->middleName = $middleName;
    $this->lastName = $lastName;
    $this->contactNumber = $contactNumber;
    $this->userType = $userType;
    $this->lastLogin = $lastLogin;
	$this->active = $active;
  }
}
?>