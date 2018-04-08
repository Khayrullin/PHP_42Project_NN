<?php
class Neuron {
     private $_type;
     private $_weights;
     private $_inputs;

    public function __construct(array $inputs, array $weights, $type)
    {
     $this->_type = $type;
     $this->_weights = $weights;
     $this->_inputs = $inputs;
    }

    public function getWeights($key)
    {
     return $this->_weights[$key];
    }

    public function setWeights($key,$value)
    {
     $this->_weights[$key] = $value;
    }

    public function getInputs($key)
    {
     return $this->_inputs[$key];
    }

    public function setInputs($key,$value)
    {
     $this->_inputs[$key] = $value;
    }

    public function output()
    {
     return $this->Activator($this->_inputs, $this->_weights);
    }

    private function Activator($i, $w)
    {
     $sum = 0;
     for ($l = 0; $l < count($i); $l++) {
        $sum = $sum + $i[$l] * $w[$l];
     }
     return pow(1 + exp(0 - $sum), -1);
    }

    public function derivativator($outsignal)
    {
     return $outsignal * (1 - $outsignal);
    }

    public function gradientor($error, $dif, $g_sum)
    {
     return ($this->_type==NeuronType::Output) ? $error * $dif : $g_sum * $dif;
    }
}