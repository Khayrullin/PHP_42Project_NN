<?php

class Neuron
{
    private $_type;
    private $_weights;
    private $_inputs;

    public function __construct($inputs, array $weights, $type)
    {
        $this->_type = $type;
        $this->_weights = $weights;
        $this->_inputs = $inputs;
    }

    /**
     * @return array
     */
    public function getWeights(): array
    {
        return $this->_weights;
    }

    /**
     * @param array $weights
     */
    public function setWeights(array $weights)
    {
        $this->_weights = $weights;
    }

    /**
     * @return array
     */
    public function getInputs(): array
    {
        return $this->_inputs;
    }

    /**
     * @param array $inputs
     */
    public function setInputs(array $inputs)
    {
        $this->_inputs = $inputs;
    }


    public function output()
    {
        return $this->activator($this->_inputs, $this->_weights);
    }

    private function activator($i, $w)
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
        return ($this->_type == NeuronType::Output) ? $error * $dif : $g_sum * $dif;
    }
}