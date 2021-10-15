<?php
use PHPUnit\Framework\TestCase;
require(__DIR__."/../../ActionPage.php");

/*
Run test from home directory: ./vendor/bin/phpunit ./di/cf/public/tests/Unit/ActionPageTest.php
*/


class ActionPageTest extends TestCase
{
    //protected $obj;
  //  protected function setUp():void
    //{
        
     //   $this->$obj = [
         /*   'fullname' => 'dummy name',
            'email' => 'dummy@email.com',
            'phone' => '000-000-0000',
            'message' => 'dummy message',
            'servername' =>'localhost',
            'username' => 'rlsjr',
            'password' => 'Sypert1234!',
            'dbname' => 'dealerinspire' */
     //   ];
   // }

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
    public function testContact() : void
    {
      
        // Test Record Insertion in Database
        $action_page = new ActionPage();
        $this->obj = $action_page->make_contact($this->obj);
        $this->assertStringContainsString('New record created',$this->obj->output);

        $conn = new mysqli($this->obj->servername, $this->obj->username, $this->obj->password, $this->obj->dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        
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

    public function testEmail() : void
    {
        // Test Sending of Email
        $action_page = new ActionPage();
        $this->obj = $action_page->send_email($this->obj);
        $this->assertStringContainsString('Message has been sent',$this->obj->output);
    }


    protected function tearDown(): void
    {
       
    }
}
?>