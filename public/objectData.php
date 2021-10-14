<?php

class objectData{

    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $fullname;
    public $email;
    public $phone;
    public $message;
    public $output;

    function __construct($obj) {

        $this->servername = $obj->servername;
        $this->username = $obj->username;
        $this->password = $obj->password;
        $this->dbname = $obj->dbname;
        $this->fullname = $obj->fullname;
        $this->email = $obj->email;
        $this->phone = $obj->phone;
        $this->message = $obj->message;
        $this->output = $obj->output;
    }   
}

?>