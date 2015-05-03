<?php namespace Acme;

class MyFooCommand {

    public $username;

    public $email;

    public $password;

    public $age;

    public function __construct($username, $email, $password, $age)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->age = $age;
    }

}