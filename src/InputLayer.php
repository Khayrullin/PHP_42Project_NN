<?php

class InputLayer
{
    private $trainset = array(
        array(array(0, 0), array(0, 1)),
        array(array(0, 1), array(1, 0)),
        array(array(1, 0), array(1, 0)),
        array(array(1, 1), array(0, 1))
    );


    /**
     * @return array
     */
    public function getTrainset()
    {
        return $this->trainset;
    }
}