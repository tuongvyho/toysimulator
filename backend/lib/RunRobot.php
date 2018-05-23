<?php

require_once 'RobotPosition.php';
require_once 'Table.php';
require_once 'Square.php';
require_once 'Command.php';

class RunRobot
{
    private $robot = null;


    public function __construct($argv)
    {
        $this->robot = new RobotPosition(new Table(5, 5));
        $consoleAr = array();
        
        for ($i = 1; $i < sizeof($argv); $i++) {
            $consoleAr[] = $argv[$i];
        }
        // check the case Run commands api intergrate with react
        if ($argv[0]=='api.php'){
            $this->runViaApi($consoleAr);

        }else{

            $this->runCommand($consoleAr); 
        }
        
        
    }
    private function runViaApi($argv){
       
       
        $commandParser = new Command($argv);
        $commands = $commandParser->getCommands();
         
        if ($commands !== null) {
            foreach ($commands as $command) {
                
                $placeArgs = preg_split("/[\s,]+/", $command);  
                if (isset($placeArgs[1])){
                        $this->robot->setplace(
                        intval($placeArgs[1]),
                        intval($placeArgs[2]),
                        $placeArgs[3]
                        ); 
                } 
                switch (trim($command)) {
                    case 'MOVE':
                        print_r($this->robot->move());
                        break;
                    case 'LEFT':
                        print_r($this->robot->left());
                        break;
                    case 'RIGHT':
                        print_r($this->robot->right());
                        break;
                    case 'REPORT':
                        print($this->robot->report() . "\n");
                        break;
                    default:
                        if($argv[1]=="PLACE"){
                            print_r($this->robot->place());    
                        }
                        break;                            
                       
                }
        
            }
        }
    }
    private function runCommand($argv){


        $commandParser = new Command($argv);
        $commands = $commandParser->getCommands();

        if ($commands !== null) {
            print("Toy Robot Simulator \n");
            print("Enter a command, Valid commands are:\n");
            print("\'PLACE X,Y,NORTH|SOUTH|EAST|WEST\', MOVE, LEFT, RIGHT, REPORT or EXIT :\n\t");
            foreach ($commands as $command) {
              // echo  $command."\n\t";
                if ($command == 'MOVE') {
                   print ($this->robot->move());
                } elseif ($command == 'LEFT') {
                   print($this->robot->left());
                } elseif ($command == 'RIGHT') {
                   print($this->robot->right());
                } elseif ($command == 'REPORT') {
                    print($this->robot->report() . "\n");
                } else {
                    $placeArgs = preg_split("/[\s,]+/", $command);

                    $this->robot->place(
                        intval($placeArgs[1]),
                        intval($placeArgs[2]),
                        $placeArgs[3]
                    );
                }
            }
        }

    }


    private function runFile($filename)
    {
        $commandParser = new Command($filename);
        $commands = $commandParser->getCommands();
        if ($commands !== null) {

            print('### Begin processing commands file: '. basename($filename) ." ###\n\n");
            print("*** Output data of valid commands ***\n\n");
           
            foreach ($commands as $command) {
                if ($command == 'MOVE') {
                    $this->robot->move();
                } elseif ($command == 'LEFT') {
                    $this->robot->left();
                } elseif ($command == 'RIGHT') {
                    $this->robot->right();
                } elseif ($command == 'REPORT') {
                    print($this->robot->report() . "\n");
                } else {
                    $placeArgs = preg_split("/[\s,]+/", $command);

                    $this->robot->place(
                        intval($placeArgs[1]),
                        intval($placeArgs[2]),
                        $placeArgs[3]
                    );
                }
            }

            print("\n".'### End processing commands file:'.basename($filename)." ###\n");
            print("^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^\n\n");
        }
    }
}