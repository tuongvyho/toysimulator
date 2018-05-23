<?php
use Codeception\Util\Stub;

require 'lib/Square.php';

class SquareTest extends \Codeception\TestCase\Test
{
   /**
    * @var \CodeGuy
    */
    protected $codeGuy;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testNew()
    {
        $this->assertInstanceOf('Square', new Square);
    }

    public function testRobotCanOccupy()
    {
        $square = new Square;
        $this->assertTrue($square->robotCanOccupy());
    }

}