<?php

class Neuron
{

    private $inputs;
    private $weights;
    private $type;

    /**
     * Neuron constructor.
     * @param $inputs
     * @param $weights
     * @param $type
     */
    public function __construct($inputs, $weights, $type)
    {
        $this->inputs = $inputs;
        $this->weights = $weights;
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getInputs()
    {
        return $this->inputs;
    }

    /**
     * @return mixed
     */
    public function getWeights()
    {
        return $this->weights;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $inputs
     */
    public function setInputs($inputs)
    {
        $this->inputs = $inputs;
    }

    /**
     * @param mixed $weights
     */
    public function setWeights($weights)
    {
        $this->weights = $weights;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

}