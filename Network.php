<?php
class Network
{
     const THRESHOLD = 0.001;
     public $fact=array();

     public $input_layer;
     public $hidden_layer;
     public $output_layer;

     public function __construct()
     {
      $this->input_layer = new InputLayer();
      $this->hidden_layer = new HiddenLayer(4, 2, NeuronType::Hidden, "hidden_layer");
      $this->output_layer = new OutputLayer(2, 4, NeuronType::Output, "output_layer");
     }

     public function getMSE(array $errors)
     {
       $sum = 0;
       for ($i = 0; $i < count($errors); $i++) {
        $sum += pow($errors[$i], 2);
       }
       return 0.5 * $sum;
     }

     public function getCost(array $mses)
     {
       $sum = 0;
       for ($i = 0; $i < count($mses); $i++){
        $sum += $mses[$i];
       }
       return ($sum / count($mses));
     }

     public function train(Network $net)
     {
      $temp_mses = array();
      $temp_cost = 0;
      $num_eon = 0;
      do {
         $num_eon++;
         for ($i = 0; $i < $net->input_layer->getCountTrainset(); $i++) {
           $net->hidden_layer->setData($net->input_layer->getTrainset($i)[0]);
           $net->hidden_layer->recognize(null, $net->output_layer);
           $net->output_layer->recognize($net, null);
           $errors = array();
           for ($x = 0; $x < count($net->input_layer->getTrainset($i)[1]); $x++) {
              $errors[$x] = $net->input_layer->getTrainset($i)[1][$x]-$net->fact[$x];
           }
           $temp_mses[$i] = $net->getMSE($errors);
           //обратный проход и коррекция весов
           $temp_gsums = $net->output_layer->backwardPass($errors);
           $net->hidden_layer->backwardPass($temp_gsums);
          }
       $temp_cost = $net->getCost($temp_mses);//вычисление ошибки по эпохе
       //Вывод ошибки по эпохе
       print("Error $temp_cost in eon $num_eon\n");
      //ВОТ ЗДЕСЬ РАБОТАЕТ ТОЛЬКО ЕСЛИ 0.19 , 0.18 уже лаг. Оригинал должен быть:
      } while ($temp_cost > Network::THRESHOLD);
 //     } while($temp_cost > 0.19);
      $net->hidden_layer->weightInitialize(MemoryMode::SET, "hidden_layer");
      $net->output_layer->weightInitialize(MemoryMode::SET, "output_layer");
     }

     public function test(Network $net)
     {
      for ($i = 0; $i < $net->input_layer->getCountTrainset(); $i++) {
       $net->hidden_layer->setData($net->input_layer->getTrainset($i)[0]);
       $net->hidden_layer->recognize($net, $net->output_layer);
       $net->output_layer->recognize($net, $net->output_layer);
       for ($j = 0; $j < count($net->fact); $j++) {
        print($net->fact[$j]."\n");
       } 
       print("\n");
      }
     }
}