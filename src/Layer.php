<?php

abstract class Layer
{
    const LEARNINGRATE = 0.1;
    protected $numofneurons;
    protected $numofprevneurons;
    private $neurons;
    private $data;

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
        //XmlDocument memory_doc = new XmlDocument();
        //memory_doc.Load($"{type}_memory.xml");
        //XmlElement memory_el = memory_doc.DocumentElement;
        switch ($mm) {
            case MemoryMode::GET:
                for ($l = 0; $l < sizeof($_weights[0]); ++$l) {
                    for ($k = 0; $k < sizeof($_weights[1]); ++$k) {
//                        $_weights[$l][$k] = double . Parse(memory_el . ChildNodes . Item(k + _weights . GetLength(1) * l) . InnerText . Replace(',','.'), System . Globalization . CultureInfo . InvariantCulture);
                    }
                }
                break;
            case MemoryMode::SET:
                for ($l = 0; $l < sizeof($this->neurons); ++$l) {
                    for ($k = 0; $k < $this->numofprevneurons; ++$k) {
                        //memory_el . ChildNodes . Item(k + numofprevneurons * l) . InnerText = Neurons[l] . Weights[k] . ToString();
                    }
                }
                break;
        }
        //memory_doc.Save($"{type}_memory.xml");
        print_r("$type weights have been initialized...");
        {
            return _weights;
        }
    }

    abstract public function Recognize(Network $net, Layer $nextLayer);//для прямых проходов

    abstract public function BackwardPass($stuff);//и обратных


}