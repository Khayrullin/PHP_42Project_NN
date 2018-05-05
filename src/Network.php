<?php
require_once "C:\Users\habar\PhpstormProjects\PHP_Photo_colouring_NN\src\HiddenLayer.php";
require_once "C:\Users\habar\PhpstormProjects\PHP_Photo_colouring_NN\src\OutputLayer.php";
require_once "C:\Users\habar\PhpstormProjects\PHP_Photo_colouring_NN\src\InputLayer.php";
require_once "C:\Users\habar\PhpstormProjects\PHP_Photo_colouring_NN\src\NeuronType.php";


class Network

{
    const THRESHOLD = 0.001;
    public $fact = array();

    private $input_layer;
    public $hidden_layer1;
    public $hidden_layer2;
    public $output_layer;

    public function __construct($mm)
    {
        $this->input_layer = new InputLayer($mm);
        $this->hidden_layer1 = new HiddenLayer(70, 15, NeuronType::Hidden, "hidden_layer1");
        $this->hidden_layer2 = new HiddenLayer(30, 70, NeuronType::Hidden, "hidden_layer2");
        $this->output_layer = new OutputLayer(10, 30, NeuronType::Output, "output_layer");
        for($i = 0; $i< 10; $i++ ){
            $this->fact[] = 0;
        }
    }


    public function train(Network $net)
    {
        //ORIGINAL   $epoches = 1200;
        $epoches = 50;
        for ($k = 0; $k < $epoches; ++$k) {
            print ("K - epochs = ".$k."<br>");
            for ($i = 0; $i < $net->input_layer->getCountTrainset(); ++$i) {
                //прямой проход
                $this->forwardPass($net, $net->input_layer->getTrainset($i)[0]);
                //вычисление ошибки по итерации
                $errors = array();
                for ($x = 0; $x < sizeof($net->fact); ++$x) {
                    $errors[$x] = ($x == $net->input_layer->getTrainset($i)[1]) ? - ($net->fact[$x] - 1.0) : - $net->fact[$x];
                }
                //обратный проход и коррекция весов
                $temp_gsums1 = $net->output_layer->backwardPass($errors);
                $temp_gsums2 = $net->hidden_layer2->backwardPass($temp_gsums1);
                $net->hidden_layer1->backwardPass($temp_gsums2);
//                print("<br>");
//                print ("Temp grsum");
//                print_r($temp_gsums1);
//                print("<br>");
            }
        }

        //загрузка скорректированных весов в "память"
        $net->hidden_layer1->weightInitialize(MemoryMode::SET, "hidden_layer1");
        $net->hidden_layer2->weightInitialize(MemoryMode::SET, "hidden_layer2");
        $net->output_layer->weightInitialize(MemoryMode::SET, "output_layer");

    }

    public function test(Network $net)
    {
        for ($i = 0; $i < $net->input_layer->getCountTestset(); $i++) {
            $this->forwardPass($net, $net->input_layer->getTestset($i));
        }
    }

    public function forwardPass(Network $net, $netInput)
    {
        $net->hidden_layer1->setData($netInput);
        $net->hidden_layer1->recognize(null, $net->hidden_layer2);
        $net->hidden_layer2->recognize(null, $net->output_layer);
        $net->output_layer->recognize($net, null);
    }
}