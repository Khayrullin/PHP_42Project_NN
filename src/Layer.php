<?php
include "C:\Users\habar\PhpstormProjects\PHP_Photo_colouring_NN\src\Memory\hidden_layer_memory.xml";
include "C:\Users\habar\PhpstormProjects\PHP_Photo_colouring_NN\src\Memory\output_layer_memory.xml";


abstract class Layer
{
    const LEARNINGRATE = 0.1;
    protected $numofneurons;
    protected $numofprevneurons;
    private $neurons;

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        for ($i = 0; $i < sizeof($this->neurons); ++$i) {
            $this->neurons[$i] = $data;
        }
    }

    public function __construct($non, $nopn, NeuronType $nt, $type)
    {
        {
            $this->numofneurons = $non;
            $this->numofprevneurons = $nopn;
            $this->setNeurons(array());
            $weights = $this->WeightInitialize(MemoryMode::GET, $type);
            for ($i = 0; $i < $non; ++$i) {
                $temp_weights = array();
                for ($j = 0; $j < $nopn; ++$j) {
                    $temp_weights[$j] = $weights[$i][$j];
                }
                $this->neurons[$i] = new Neuron(null, $temp_weights, $nt);
            }
        }
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

    public function WeightInitialize($mm, $type)
    {
        $_weights = array(array(), array());
        print_r("$type weights are being initialized...");
        $memory_doc = simplexml_load_file("$type" . "_memory.xml");
        $memory_el = new SimpleXMLElement($memory_doc);
        $index = 0;
        switch ($mm) {
            case MemoryMode::GET:
                for ($l = 0; $l < $this->numofneurons; ++$l) {
                    for ($k = 0; $k < $this->numofprevneurons; ++$k) {
                        $_weights[$l][$k] = $memory_el->children()[$index];
                        $index += 1;
                    }
                }
                break;
            case MemoryMode::SET:
                for ($l = 0; $l < sizeof($this->neurons); ++$l) {
                    for ($k = 0; $k < $this->numofprevneurons; ++$k) {
     //                   $memory_el = 0;
                        $index += 1;
                    }
                }
                break;
        }
        $memory_doc->saveXML($memory_el);
        print_r("$type weights have been initialized...");
        {
            return $_weights;
        }
    }

    abstract public function Recognize(Network $net, Layer $nextLayer);//для прямых проходов

    abstract public function BackwardPass($stuff);//и обратных


}