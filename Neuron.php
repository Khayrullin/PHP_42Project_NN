<?php

class Neuron {

    private $_type;
    private $_weights;
    private $_inputs;
    private $_output;
    private $_derivative;
    private $a = 0.01;

    public function __construct(array $inputs, array $weights, $type) {
        $this->_type = $type;
        $this->_weights = $weights;
        $this->_inputs = $inputs;
    }

    public function getWeights($key) {
        return $this->_weights[$key];
    }

    public function setWeights($key, $value) {
        $this->_weights[$key] = $value;
    }

    public function getInputs($key) {
        return $this->_inputs[$key];
    }

    public function setInputs($key, $value) {
        $this->_inputs[$key] = $value;
    }

    public function getOutput() {
        return $this->_output;
    }

    public function getDerivative() {
        return $this->_derivative;
    }

    public function output() {
        return $this->activator($this->_inputs, $this->_weights);
    }

    private function activator($i, $w) {
        $sum = $w[0];
        for ($l = 0; $l < count($i); $l++) {
            $sum = $sum + $i[$l] * $w[$l + 1];
        }
        switch ($this->_type) {
            case NeuronType::Hidden: {
                    $this->_output = $this->leakyReLU($sum);
                    $this->_derivative = $this->leakyReLU_Derivativator($sum);
                    break;
                }
            case NeuronType::Output: {
                    $this->_output = exp($sum);
                    break;
                }
        }
    }

    private function leakyReLU($sum) {
        return ($sum >= 0) ? $sum : $this->a * $sum;
    }

    private function leakyReLU_Derivativator($sum) {
        return ($sum >= 0) ? 1 : $this->a;
    }

}
