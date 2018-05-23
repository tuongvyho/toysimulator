<?php
    
/**
     Class  RobotPosition  
     author:Vyho 
*/
class RobotPosition {

    public $table;
    private $aspect = null;
    private $location = null;
    private $direction = ['NORTH', 'EAST', 'SOUTH', 'WEST'];

    public function __construct($table)
    {
        $this->tabletop = $table;

        $this->location =   ['x' => null, 'y' => null];
  

    }

    public function report()
    {
        if ($this->hasBeenPlaced()) {
            $output = 'Output: '
            . $this->location['x'] . ', '
            . $this->location['y'] . ', '
            . $this->direction[$this->aspect];

            return $output;
        } else {
            return '';
        }
    }

     public function place()
    {
        if (!$this->hasBeenPlaced()) {
            return;
        } elseif ($this->tabletop->isValidXY(
            $this->location['x'],
            $this->location['y'],
            $this->direction[$this->aspect])
        ){
            return $this->report();
        } else {
            return;
        }
      
    }
    public function setplace($x, $y, $aspectInString)
    {
       
        $tmpAspectIndex = array_search($aspectInString, $this->direction);

        if ($this->tabletop->isValidXY($x, $y) && $tmpAspectIndex !== false) {
            $this->location['x'] = $x;
            $this->location['y'] = $y;
            $this->aspect = $tmpAspectIndex; 
            
        } else {
            return;
        }
    }

    public function left()
    {
        if (!$this->hasBeenPlaced()) {
            return;
        } elseif ($this->tabletop->isValidXY(
            $this->location['x'],
            $this->location['y'],
            $this->direction[$this->aspect])
        ){
            $this->aspect -= 1;

            if ($this->aspect < 0) {
                $this->aspect = 3;
            }

        } else {
            return;
        }
        return $this->report();
    }

    public function right()
    {
        if (!$this->hasBeenPlaced()) {
            return;
        } elseif ($this->tabletop->isValidXY(
            $this->location['x'],
            $this->location['y'],
            $this->direction[$this->aspect])
        ){
            $this->aspect += 1;

            if ($this->aspect >= sizeof($this->direction)) {
                $this->aspect = 0;
            }
        } else {
            return;
        }
        return $this->report();
    }

    public function move()
    {


        if (!$this->hasBeenPlaced()) {
            return;
        }

        if ($this->aspect == array_search('NORTH', $this->direction)) {
            
            $newLocation = $this->getNewLocation(0, 1);
            
            $square =   $this->tabletop->getSquare(
                $newLocation['x'],
                $newLocation['y']
                );

            if ($this->isValidSquare($newLocation)) {
                $this->location = $newLocation;
            } else {
                return;
            }

            
        } elseif ($this->aspect == array_search('EAST', $this->direction)) {
            $newLocation = $this->getNewLocation(1, 0);

            if ($this->isValidSquare($newLocation)) {
                $this->location = $newLocation;
            } else {
                return;
            }
        } elseif ($this->aspect == array_search('SOUTH', $this->direction)) {
            $newLocation = $this->getNewLocation(0, -1);

            if ($this->isValidSquare($newLocation)) {
                $this->location = $newLocation;
            } else {
                return;
            }
        } elseif ($this->aspect == array_search('WEST', $this->direction)) {
            $newLocation = $this->getNewLocation(-1, 0);

            if ($this->isValidSquare($newLocation)) {
                $this->location = $newLocation;
            } else {
                return;
            }
        } else {
            return;
        }

        return $this->report();            
    }

    private function hasBeenPlaced()
    {
        $anyNull =  $this->location['x'] === null ||
        $this->location['y'] === null ||
        $this->aspect === null;

        if ($anyNull) {
            return false;
        } else {
            return true;
        }
    }

    private function getNewLocation($xOffset, $yOffset)
    {
        $newLocation = [
        'x' => $this->location['x'] + $xOffset,
        'y' => $this->location['y'] + $yOffset
        ];

        return $newLocation;
    }

    private function isValidSquare($newLocation)
    {
        $square =   $this->tabletop->getSquare(
            $newLocation['x'],
            $newLocation['y']
            );

        if ($square !== null) {
            return true;
        } else {
            return false;
        }
    }

}


?>