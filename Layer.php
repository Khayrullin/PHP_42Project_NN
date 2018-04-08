<?php
abstract class Layer{

     protected $numofneurons;
     protected $numofprevneurons;
     protected $learningrate = 0.1;
     protected $_neurons = array();

     public function __construct($non, $nopn, $nt, $type)
      {
       $_weights = array();
       $this->numofneurons = $non;
       $this->numofprevneurons = $nopn;
       $_weights = $this->weightInitialize(MemoryMode::GET, $type);
       for ($i = 0; $i < $non; $i++) {
         for ($j = 0; $j < $nopn; $j++) {
          $temp_weights[$j] = $_weights[$i][$j];
         }
        $this->setNeurons($i, new Neuron(array(), $temp_weights, $nt));
        }
      }

     public function getNeurons($key)
      {
       return $this->_neurons[$key];
      }

     public function setNeurons($key, $value)
      {
       $this->_neurons[$key] = $value;
      }

     public function setData(array $value)
      {
       for($i = 0; $i < $this->numofneurons; $i++) {
        for($j = 0; $j < $this->numofprevneurons; $j++) {
         $this->getNeurons($i)->setInputs($j, $value[$j]);
        }
       } 
      }

     public function weightInitialize($mm, $type)
      {
       $_weights = array();
       print("$type weights are being initialized...\n");
       $memory_doc = simplexml_load_file($type."_memory.xml");

       switch ($mm) {
        case MemoryMode::GET: {
          for ($l = 0; $l < $this->numofneurons; $l++) {
           for ($k = 0;$k < $this->numofprevneurons; $k++){
            $_weights[$l][] = (float) $memory_doc->weight[$k+$this->numofprevneurons*$l];
           }
          }
        break;
        }
        case MemoryMode::SET: {
          for ($l = 0; $l < $this->numofneurons; $l++) {
           for ($k = 0; $k < $this->numofprevneurons; $k++) {
            $memory_doc->weight[$k+$this->numofprevneurons*$l] = $this->getNeurons($l)->getWeights($k);
           }
          } 
        break;
        }
       }
      $memory_doc->asXML($type."_memory.xml");
      print("$type weights have being initialized...\n");
      return $_weights;
      }

      abstract public function recognize($net, $nextLayer);
      abstract public function backwardPass(array $stuff);
}