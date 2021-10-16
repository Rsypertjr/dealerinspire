<?php
//Load Composer's autoloader
require __DIR__.'/../vendor/autoload.php';


class MySqlDb {

    private $obj;
    function __construct($obj) {
        $this->obj = $obj;
    }

    public function openDbConnection(){
        // Create connection
        $conn = null;
        if (extension_loaded('mysqli')) {
            $conn = new \mysqli($this->obj->servername, $this->obj->username, $this->obj->password, $this->obj->dbname);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
        }
        else{
            die('The MySQLi extension is not available.');
        }

        return $conn;
    }



    
    
}


?>
