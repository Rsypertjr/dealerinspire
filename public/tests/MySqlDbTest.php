
<?php
use PHPUnit\Framework\TestCase;

/**
 * @requires extension mysqli
 */
final class MySqlDbTest extends TestCase
{


    protected function setUp():void
    {
        
         $this->obj = [];
         $this->obj = (object)$this->obj;
         $this->obj->servername = 'localhost';
         $this->obj->username = 'rlsjr';
         $this->obj->password = 'Sypert1234!';
         $this->obj->dbname = 'dealerinspire';
         $this->obj->output = '';
         
 
    }
    /**
     * @requires PHP >= 5.3
     */
    public function testConnection(): void
    {
        $db= new MySqlDb($this->obj);
        $conn = $db->openDbConnection($this->obj);
        $this->assertNotEmpty($conn);
    }

}



?>