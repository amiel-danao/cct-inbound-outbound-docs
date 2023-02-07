<?php
class User {
  public $id;
  public $username;
  public $firstName;
  public $middleName;
  public $lastName;
  public $contactNumber;
  public $userType;

  public function __construct($id, $username, $firstName, $middleName, $lastName, $contactNumber, $userType) {
    $this->id = $id;
    $this->username = $username;
    $this->firstName = $firstName;
    $this->middleName = $middleName;
    $this->lastName = $lastName;
    $this->contactNumber = $contactNumber;
    $this->userType = $userType;
  }
}
?>