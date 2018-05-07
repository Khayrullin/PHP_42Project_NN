<?php

abstract class Layer {

    protected $numofneurons;
    protected $numofprevneurons;
    protected $learningrate = 0.005;
    protected $momentum = 0.03;
    protected $lastdeltaweights = array();
    protected $_neurons = array();

    public function __construct($non, $nopn, $nt, $type, $rand = false) {
        if ($rand) {
            $randGen = new InitRandWeights($non, $nopn, $type);
        }

        $_weights = array();
        $this->numofneurons = $non;
        $this->numofprevneurons = $nopn;
        $_weights = $this->weightInitialize(MemoryMode::GET, $type);
        $this->lastdeltaweights = $_weights;
        for ($i = 0; $i < $non; $i++) {
            for ($j = 0; $j < ($nopn + 1); $j++) {
                $temp_weights[$j] = $_weights[$i][$j];
            }
            $this->setNeurons($i, new Neuron(array(), $temp_weights, $nt));
        }
    }

    public function getNeurons($key) {
        return $this->_neurons[$key];
    }

    public function setNeurons($key, $value) {
        $this->_neurons[$key] = $value;
    }

    public function setData(array $value) {
        for ($i = 0; $i < $this->numofneurons; $i++) {
            for ($j = 0; $j < $this->numofprevneurons; $j++) {
                $this->getNeurons($i)->setInputs($j, $value[$j]);
            }
            $this->getNeurons($i)->output();
        }
    }

    public function weightInitialize($mm, $type) {
        $_weights = array();
        $memory_doc = simplexml_load_file($type . "_memory.xml");

        switch ($mm) {
            case MemoryMode::GET: {
                    for ($l = 0; $l < $this->numofneurons; $l++) {
                        for ($k = 0; $k < ($this->numofprevneurons + 1); $k++) {
                            $_weights[$l][] = (float) $memory_doc->weight[$k + ($this->numofprevneurons + 1) * $l];
                        }
                    }
                    break;
                }
            case MemoryMode::SET: {
                    for ($l = 0; $l < $this->numofneurons; $l++) {
                        for ($k = 0; $k < ($this->numofprevneurons + 1); $k++) {
                            $memory_doc->weight[$k + ($this->numofprevneurons + 1) * $l] = $this->getNeurons($l)->getWeights($k);
                        }
                    }
                    break;
                }
        }
        $memory_doc->asXML($type . "_memory.xml");
        return $_weights;
    }

    abstract public function recognize($net, $nextLayer);

    abstract public function backwardPass(array $stuff);
}
