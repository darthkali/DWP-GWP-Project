<?php
namespace FSR_AI;

class users
{
    private $forename;
    private $surname;
    private $email;
    private $dateOfBirth;
    private $description;
    private $username;
    private $password;
    private $role;
    private $functionFSR;


    public function __construct($forename, $surname, $email, $dateOfBirth, $role, $functionFSR){
        $this->forename = $forename;
        $this->surname = $surname;
        $this->email = $email;
        $this->dateOfBirth = $dateOfBirth;
        $this->role = $role;
        $this->functionFSR = $functionFSR;
    }

    public function __get($name){

        // TODO: Implement __get() method.
    }

    public function __set($name, $value){

        // TODO: Implement __set() method.
    }
}
