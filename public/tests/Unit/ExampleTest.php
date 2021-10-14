<?php
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testFailure()
    {
        $this->assertEmpty(['Valuebound']);
    }

    public function testFailure2(){
        $this->assertEquals(1,1);
    }

    public function testFailure3(){
        $this->assertEquals('bar','baz');
    }


}
?>
view raw