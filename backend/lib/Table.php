<?php

    
/**
     Class  draw table   
     author:Vyho 
*/

class Table 
{
    private $tabletop = null;

    public function __construct($xMax = 1, $yMax = 1)
    {
        $this->tabletop = array_fill(
            0,
            $xMax,
            array_fill(0, $yMax, new Square)
            );
    }


    public function getXMax()
    {
        return sizeof($this->tabletop);
    }

    public function getYMax()
    {
        return sizeof($this->tabletop[0]);
    }

    public function getSquare($x, $y)
    {
        if ($this->isValidXY($x, $y)) {
            return $this->tabletop[$x][$y];
        } else {
            return null;
        }
    }

    public function isValidXY($x, $y)
    {
        $isInt =    is_int($x) &&
        is_int($y);

        $Range =    $x >= 0 &&
        $y >= 0 &&
        $x < $this->getXMax() &&
        $y < $this->getYMax();

        if ($isInt && $Range) {
            return true;
        } else {
            return false;
        }
    }
}