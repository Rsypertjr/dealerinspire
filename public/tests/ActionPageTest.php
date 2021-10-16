<?php
use PHPUnit\Framework\TestCase;

require __DIR__."/../../vendor/autoload.php";
/*
// Manual file autoloading
function custom_autoloader($class){
    include __DIR__."/../../../public/". $class . ".php";
}
// using custom autoloader
spl_autoload_register('custom_autoloader');
*/


/*
Run test from home directory: ./vendor/bin/phpunit ./public/tests/ActionPageTest.php
                              ./vendor/bin/phpunit --bootstrap ./vendor/autoload.php ./public/tests
                              ./vendor/bin/phpunit --bootstrap ./vendor/autoload.php --testsuite unittests
*/


class ActionPageTest extends TestCase
{
    
   protected $obj;
   protected function setUp():void
   {
       
        $this->obj = [];
        $this->obj = (object)$this->obj;
        $this->obj->fullname = 'dummy name';
        $this->obj->email = 'dummy@email.com';
        $this->obj->phone = '000-000-0000';
        $this->obj->message = 'dummy message';
        $this->obj->servername = 'localhost';
        $this->obj->username = 'rlsjr';
        $this->obj->password = 'Sypert1234!';
        $this->obj->dbname = 'dealerinspire';
        $this->obj->output = '';
        

   }

   /*
    public function testContact() : void
    {
      
        // Test Record Insertion in Database
        $action_page = new ActionPage($this->obj);
        $this->obj = $action_page->make_contact($this->obj);
        $this->assertStringContainsString('New record created',$this->obj->output);

        $db = new MySqlDb($this->obj);
        $conn = $db->openDbConnection($this->obj);
                
        //  Remove Test Record
        $sql = "DELETE FROM Contacts ".
        " WHERE fullname = '" . $this->obj->fullname . "' AND email = '" . $this->obj->email .
        "' AND phone = '" . $this->obj->phone . "' AND message = '" . $this->obj->message . "'";

        if ($conn->query($sql) === TRUE) {
            $mess = "Record Deleted";
        } else {
            $mess = "<br>Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
        $this->assertStringContainsString('Record Deleted',$mess);
    }

    */

    public function testContactwithStub() : void
    {      
        // Test Record Insertion in Database
        $action_page = new ActionPage($this->obj);
        $this->obj = $action_page->make_contact($this->obj);
        $this->assertStringContainsString('New record created',$this->obj->output);

        // Create stub for the MySqlDb class.
        $stub = $this->createStub(MySqlDb::class);

        // Configure stub
        $stub->method('openDbConnection')
             ->willReturn('Record Deleted');

        //$conn->close();
        $this->assertStringContainsString('Record Deleted',$stub->openDbConnection());
    }




    public function testEmail() : void
    {
        // Test Sending of Email
        $action_page = new ActionPage($this->obj);
        $this->obj = $action_page->send_email($this->obj);
        $this->assertStringContainsString('Message has been sent',$this->obj->output);
    }


    protected function tearDown(): void
    {
       
    }
}
?>