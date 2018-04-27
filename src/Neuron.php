<?php

class Neuron
{
    private $_type;
    private $_weights;
    private $_inputs;
    private $_output;
    private $_derivative;
    private $a = 0.01;

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

    public function setWeights($key, $value)
    {
        $this->_weights[$key] = $value;
    }

    public function getInputs($key)
    {
        return $this->_inputs[$key];
    }

    public function setInputs($key, $value)
    {
        $this->_inputs[$key] = $value;
    }

    public function output()
    {
        return $this->_output;
    }

    public function Activator($i, $w)
    {
        $sum = $w[0];
        for ($l = 0; $l < count($i); $l++) {
            $sum += $i[$l] * $w[$l + 1];
        }
        switch ($this->_type) {
            case NeuronType::Hidden:
                $this->_output = $this->LeakyReLU($sum);
                $this->_derivative = $this->LeakyReLU_Derivativator($sum);
                break;
            case NeuronType::Output:
                $this->_output = exp($sum);
                break;
        }
        return pow(1 + exp(0 - $sum), -1);
    }

    public function getDerivative()
    {
        return $this->_derivative;
    }

    public function LeakyReLU($sum)
    {
        return ($sum >= 0) ? $sum : $this->a * $sum;
    }

    public function LeakyReLU_Derivativator($sum)
    {
        return ($sum >= 0) ? 1 : $this->a;
    }
}