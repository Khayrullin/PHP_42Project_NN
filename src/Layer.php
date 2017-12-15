<?php

abstract class Layer
{
    const LEARNINGRATE = 0.1;
    protected $numofneurons;
    protected $numofprevneurons;
    private $neurons;
    private $data;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getNeurons()
    {
        return $this->neurons;
    }

    /**
     * @param mixed $neurons
     */
    public function setNeurons($neurons)
    {
        $this->neurons = $neurons;
    }


}