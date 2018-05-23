<?php
use Codeception\Util\Stub;

require_once 'lib/Command.php';

class CommandParserTest extends \Codeception\TestCase\Test
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
        
        //assert "LEFT"
        $commandParser = new Command('testfiles/Codeception_unit_test_files/leftcommandfile');
        $this->assertEquals(['LEFT'], $commandParser->getCommands());

        //assert "RIGHT"
        $commandParser = new Command('testfiles/Codeception_unit_test_files/leftcommandfile');
        $this->assertEquals(['RIGHT'], $commandParser->getCommands());

        //assert "REPORT"
        $commandParser = new Command('testfiles/Codeception_unit_test_files/reportcommandfile');
        $this->assertEquals(['REPORT'], $commandParser->getCommands());

        //assert "PLACE" command with exact spacing/position and case.
        $commandParser = new Command('testfiles/Codeception_unit_test_files/placecommandfile');
        $this->assertEquals(['PLACE0,0,NORTH'], $commandParser->getCommands());

        //assert move
        $commandParser = new Command('testfiles/Codeception_unit_test_files/movecommandfile');
        $this->assertEquals(['MOVE'], $commandParser->getCommands());

        //test file with mixed commands
        $commandParser = new Command('testfiles/Codeception_unit_test_files/mixedcommandfile');
        $this->assertEquals([
            'MOVE',
            'LEFT',
            'RIGHT',
            'REPORT',

            'PLACE0,0,NORTH'
        ], $commandParser->getCommands());

        //file with errors
        $commandParser = new Command('testfiles/Codeception_unit_test_files/erroredfile');
        $this->assertInstanceOf('CommandParser', $commandParser);

    }

    public function testNewWithBadCommandHandling()
    {

        /*
        *  test file with errored commands handling (clean up strings)
        *  test rebase array keys after unsetting errored elements in array
        */ 
        $commandParser = new Command('testfiles/Codeception_unit_test_files/badcommands');
        $this->assertEquals([
            'PLACE0,0,SOUTH',
            'RIGHT',
            'MOVE',
            'LEFT',
            'REPORT'
        ], $commandParser->getCommands()); 



    }
}