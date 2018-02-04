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
            $weights = $this->WeightInitialize(new MemoryMode(1), $type);
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

    public function WeightInitialize(MemoryMode $mm, $type)
    {
        $_weights = array(array(), array());
        print_r("$type weights are being initialized...");
//XmlDocument memory_doc = new XmlDocument();
//memory_doc.Load($"{type}_memory.xml");
//XmlElement memory_el = memory_doc.DocumentElement;
//switch (mm)
//{
//case MemoryMode.GET:
//for (int l = 0; l < _weights.GetLength(0); ++l)
//for (int k = 0; k < _weights.GetLength(1); ++k)
//_weights[l, k] = double.Parse(memory_el.ChildNodes.Item(k + _weights.GetLength(1) * l).InnerText.Replace(',', '.'), System.Globalization.CultureInfo.InvariantCulture);//parsing stuff
//break;
//case MemoryMode.SET:
//for (int l = 0; l < Neurons.Length; ++l)
//for (int k = 0; k < numofprevneurons; ++k)
//memory_el.ChildNodes.Item(k + numofprevneurons * l).InnerText = Neurons[l].Weights[k].ToString();
//break;
//}
//memory_doc.Save($"{type}_memory.xml");
//            WriteLine($"{type} weights have been initialized...");
        return _weights;
    }


}