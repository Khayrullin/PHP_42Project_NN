<?php
include "C:\Users\habar\PhpstormProjects\PHP_Photo_colouring_NN\src\hidden_layer_memory.csv";
include "C:\Users\habar\PhpstormProjects\PHP_Photo_colouring_NN\src\output_layer_memory.csv";
include "C:\Users\habar\PhpstormProjects\PHP_Photo_colouring_NN\src\MemoryMode.php";
include "C:\Users\habar\PhpstormProjects\PHP_Photo_colouring_NN\src\Neuron.php";


abstract class Layer
{
    //   const LEARNINGRATE = 0.1;
    const LEARNINGRATE = 1;
    protected $numofneurons;
    protected $numofprevneurons;
    protected $neurons;
    protected $memory_doc = false;

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        for ($i = 0; $i < sizeof($this->neurons); ++$i) {
            $this->neurons[$i]->setInputs($data);
        }
    }

    public function __construct($non, $nopn, $nt, $type)
    {
        {
            $this->numofneurons = $non;
            $this->numofprevneurons = $nopn;
            $this->setNeurons(array());
            $weights = $this->weightInitialize(MemoryMode::GET, $type);
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

    public function weightInitialize($mm, $type)
    {
        $_weights = array(array(), array());
        print_r("$type weights are being initialized...<br>");
        switch ($mm) {
            case MemoryMode::GET:
                $this->memory_doc = fopen("$type" . "_memory.csv", "r");
                for ($l = 0; $l < $this->numofneurons; ++$l) {
                    for ($k = 0; $k < $this->numofprevneurons; ++$k) {
                        $_weights[$l][$k] = fgetcsv($this->memory_doc, 8)[0];
                    }
                }
                break;
            case MemoryMode::SET:
                $this->memory_doc = fopen("$type" . "_memory.csv", "w");
                for ($l = 0; $l < sizeof($this->neurons); ++$l) {
                    for ($k = 0; $k < $this->numofprevneurons; ++$k) {
                        fputcsv($this->memory_doc, explode(',', $this->neurons[$l]->getWeights()[$k]));
                    }
                }

                break;
        }
        fclose($this->memory_doc);

        print_r("$type weights have been initialized...<br>");
        return $_weights;
    }

    abstract public function recognize($net, $nextLayer);//для прямых проходов

    abstract public function backwardPass($stuff);//и обратных


}