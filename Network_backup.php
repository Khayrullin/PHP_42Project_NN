<?php
    class Network
{
     public $fact=array();
     private $input_layer;
     public  $hidden_layer1;
     public  $hidden_layer2;
     public  $output_layer;

     public function __construct($nm, $rand = false)
     {
      $this->input_layer = new InputLayer($nm);
      $this->hidden_layer1 = new HiddenLayer(70, 15, NeuronType::Hidden, "hidden_layer1", $rand);
      $this->hidden_layer2 = new HiddenLayer(30, 70, NeuronType::Hidden, "hidden_layer2", $rand);
      $this->output_layer = new OutputLayer(10, 30, NeuronType::Output, "output_layer", $rand);
      $this->fact=array_fill(0,10,null);
     }

     public function train(Network $net)
     {
      $epoches = 1200;
       for ($k = 0; $k < $epoches; $k++) {
         for ($i = 0; $i < $net->input_layer->getCountTrainset(); $i++) {
          $this->forwardPass($net,$net->input_layer->getTrainset($i)[0]);
          $errors = array();
          for ($x = 0; $x < count($net->fact); $x++) {
           $errors[$x]=($x==$net->input_layer->getTrainset($i)[1]) ? (0-($net->fact[$x]-1)) : (0-($net->fact[$x]));
          }
          $temp_gsums1 = $net->output_layer->backwardPass($errors);
          $temp_gsums2 = $net->hidden_layer2->backwardPass($temp_gsums1);
          $net->hidden_layer1->backwardPass($temp_gsums2);
         }
       }
      $net->hidden_layer1->weightInitialize(MemoryMode::SET, "hidden_layer1");
      $net->hidden_layer2->weightInitialize(MemoryMode::SET, "hidden_layer2");
      $net->output_layer->weightInitialize(MemoryMode::SET, "output_layer");
     }

     public function test(Network $net)
     {
      for ($i = 0; $i < $net->input_layer->getCountTestset(); $i++) {
       $this->forwardPass($net,$net->input_layer->getTestset($i)[0]);
       for($j=0;$j<count($net->fact);$j++)
        echo $net->fact[$j]."\n";
       echo "\n";
      }
     }

     public function forwardPass(Network $net, array $netInput)
     {
      $net->hidden_layer1->setData($netInput);
      $net->hidden_layer1->Recognize(null,$net->hidden_layer2);
      $net->hidden_layer2->Recognize(null,$net->output_layer);
      $net->output_layer->Recognize($net,null);

     }
}