<?php


class Command {

	private $commandsArray = null;
	public function __construct($argv = null)
    {
    	if($argv == null){
    		print('No console.');
    		return;
    	}else{
            $this->commandsArray =$argv;
	 	
            $this->removeBadcommands($this->findBadCommands()); 
    	}
	}
	
	public function getCommands()
	{
	    return $this->commandsArray;
	}

	private function findbadcommands(){

	    $badcommands = array();
	    $idx = 0;
	 	
	    foreach ($this->commandsArray as &$newCommand) {
	    	
	        $newCommand = strtoupper($newCommand);
	        if (!(  
	            $this->isMoveCommand($newCommand) ||
	            $this->isLeftCommand($newCommand) ||
	            $this->isRightCommand($newCommand) ||
	            $this->isReportCommand($newCommand) ||
	            $this->isPlaceCommand($newCommand)
	            )
	            ){             
	            $badcommands[] = $idx;
	   		}
	   		 $idx++;
		}
		return $badcommands;   
	}

	public function removeBadcommands($badcommands){
		
	    if(!empty($badcommands)){
	        foreach($badcommands as $badcommand ){
	            unset($this->commandsArray[$badcommand]);
	        }
	        $this->commandsArray = array_values($this->commandsArray);
	    }
	    return  $this->commandsArray;
	}

	private function isMoveCommand($currentLine)
	{
	    $pattern = '/^MOVE$/';
	    return $this->evaluatePattern($pattern, $currentLine);
	}

	private function isLeftCommand($currentLine)
	{
	    $pattern = '/^LEFT$/';

	    return $this->evaluatePattern($pattern, $currentLine);
	}

	private function isRightCommand($currentLine)
	{
	    $pattern = '/^RIGHT$/';

	    return $this->evaluatePattern($pattern, $currentLine);
	}

	private function isReportCommand($currentLine)
	{
	    $pattern = '/^REPORT$/';

	    return $this->evaluatePattern($pattern, $currentLine);
	}

	private function isPlaceCommand(&$currentLine)
	{

	    $placeArray = null;
	    $placeString = "PLACE";
	    $trimmedString = '';
		
	    if(strpos($currentLine, $placeString) !== false){

	        $placeArray = explode(",",substr($currentLine, strpos($currentLine, $placeString) + 5));	
	        foreach($placeArray as &$value){
	            $value = trim($value);
	        }
	        $trimmedString = implode(", ", $placeArray);

	    }else{

	        return false;
	    }
	  
	    $currentLine = $placeString." ".$trimmedString;
	  
	    $pattern = '/^PLACE [0-9]+, [0-9]+, (?:NORTH|EAST|SOUTH|WEST)$/';
	    return $this->evaluatePattern($pattern, $currentLine);
	}

	private function evaluatePattern($pattern, $currentLine)
	{
	    $result = preg_match($pattern, $currentLine);

	    if ($result == 1) {
	        return true;
	    } else {
	        return false;
	    }
	}
}


?>