<?php
class HiddenLayer extends Layer
{

     public function recognize($net, $nextLayer)
     {
      $hidden_out = array();
      for ($i = 0; $i < $this->numofneurons; $i++){
        $hidden_out[$i] = $this->getNeurons($i)->output();
      }
      $nextLayer->setData($hidden_out);
     }

     public function backwardPass(array $gr_sums)
     {
      $gr_sum = null;
      for ($i = 0; $i < $this->numofneurons; $i++) {
       for ($n = 0; $n < $this->numofprevneurons; $n++) {
        $this->getNeurons($i)->setWeights(
            $n,
            ($this->getNeurons($i)->getWeights($n)+
             $this->learningrate*
             $this->getNeurons($i)->getInputs($n)*
             $this->getNeurons($i)->gradientor(
                    0,
                    $this->getNeurons($i)->derivativator(
                        $this->getNeurons($i)->output()),
                    $gr_sums[$i])));
       }
      } 
      return $gr_sum;
     }
}