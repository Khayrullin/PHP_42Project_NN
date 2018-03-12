<?php
require_once "C:\Users\habar\PhpstormProjects\PHP_Photo_colouring_NN\src\InputLayer.php";
require_once "C:\Users\habar\PhpstormProjects\PHP_Photo_colouring_NN\src\HiddenLayer.php";
require_once "C:\Users\habar\PhpstormProjects\PHP_Photo_colouring_NN\src\OutputLayer.php";
require_once "C:\Users\habar\PhpstormProjects\PHP_Photo_colouring_NN\src\NeuronType.php";

class Network
{
    const THRESHOLD = 0.001;
    public $fact = array(0, 0);

    public $input_layer;
    public $hidden_layer;
    public $output_layer;

    /**
     * Network constructor.
     * @internal param InputLayer $input_layer
     * @internal param HiddenLayer $hidden_layer
     * @internal param OutputLayer $output_layer
     */
    public function __construct()
    {
        $this->input_layer = new InputLayer();
        $this->hidden_layer = new HiddenLayer(4, 2, NeuronType::Hidden, "hidden_layer");
        $this->output_layer = new OutputLayer(2, 4, NeuronType::Output, "output_layer");
    }

    function getMSE($errors)
    {
        $sum = 0;
        for ($i = 0; $i < count($errors); ++$i) {
            $sum += pow($errors[$i], 2);
        }
        return 0.5 * $sum;
    }

    function getCost($mses)
    {
        $sum = 0;
        for ($i = 0; $i < count($mses); ++$i) {
            $sum += $mses[$i];
        }
        return ($sum / count($mses));
    }

    static function train(Network $net)
    {
        $temp_mses = array();
        do {
            for ($i = 0; $i < count($net->input_layer->getTrainset()); ++$i) {
                print("<br>");
                print_r($net->input_layer->getTrainset()[$i]);
                print("<br>");
                $net->hidden_layer->setData($net->input_layer->getTrainset()[$i][0]);
                $net->hidden_layer->recognize(null, $net->output_layer);
                $net->output_layer->recognize($net, null);

                $errors = [];
                for ($x = 0; $x < count($net->input_layer->getTrainset()[$i][1]); ++$x) {
                    $errors[$x] = $net->input_layer->getTrainset()[$i][1][$x] - $net->fact[$x];
                }
                $temp_mses[$i] = $net->getMSE($errors);
                //обратный проход и коррекция весов
                $temp_gsums = $net->output_layer->backwardPass($errors);
                $net->hidden_layer->backwardPass($temp_gsums);
            }
            $temp_cost = $net->getCost($temp_mses);//вычисление ошибки по эпохе

            echo $temp_cost;
        } while ($temp_cost > Network::THRESHOLD);

        $net->hidden_layer->weightInitialize('SET', "hidden_layer");
        $net->output_layer->weightInitialize('SET', "output_layer");
    }

    static function test(Network $net)
    {

        for ($i = 0; $i < count($net->input_layer->getTrainset()); ++$i) {
            $net->hidden_layer->setData($net->input_layer->getTrainset()[$i][0]);
            $net->hidden_layer->recognize(null, $net->output_layer);
            $net->output_layer->recognize($net, null);
            for ($j = 0; $j < count($net->fact); ++$j) {
                var_dump($net->fact[$j]);
            }
            echo "<br>";
        }
    }


}
