<?php
class InputLayer {

     private $_trainset=array(array(array(0,0),array(0,1)),
			     array(array(0,1),array(1,0)),
			     array(array(1,0),array(1,0)),
			     array(array(1,1),array(0,1)));
    public function getTrainset($key)
     {
      return $this->_trainset[$key];
     }

    public function getCountTrainset()
     {
      return count($this->_trainset);
     }
}
?>