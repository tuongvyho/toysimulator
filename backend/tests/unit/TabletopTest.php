<?php
use Codeception\Util\Stub;

require_once 'lib/Table.php';

class tableTest extends \Codeception\TestCase\Test
{
   /**
    * @var \CodeGuy
    */
    protected $codeGuy,
              $table;

    protected function _before()
    {
        $this->table = new Table(5, 5);
    }

    protected function _after()
    {
    }

    // tests
    public function testNew()
    {
        $this->assertInstanceOf('table', $this->table);
    }

    public function testGetXMax()
    {
        $this->assertEquals(5, $this->table->getXMax());
    }

    public function testGetYMax()
    {
        $this->assertEquals(5, $this->table->getYMax());
    }

    public function testGetSquare()
    {
        $this->assertInstanceOf('Square', $this->table->getSquare(2, 3));
    }

    public function testNegativeIndexGetSquare()
    {
        $this->assertNull($this->table->getSquare(-2, -3));
        $this->assertNull($this->table->getSquare(1, -3));
        $this->assertNull($this->table->getSquare(-2, 1));
    }
}