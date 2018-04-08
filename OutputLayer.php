<?php
class OutputLayer extends Layer
{

     public function recognize($net, $nextLayer)
     {
      for ($i = 0; $i < $this->numofneurons; $i++) {
        $net->fact[$i] = $this->getNeurons($i)->output();
      }
     }

    public function backwardPass(array $errors)
    {
     $gr_sum = array();
     for ($j = 0; $j < $this->numofprevneurons; $j++) {
       $sum = 0;
       for ($k = 0; $k < $this->numofneurons; $k++) {
         $sum +=
            $this->getNeurons($k)->getWeights($j)*
            $this->getNeurons($k)->gradientor(
                $errors[$k],
                $this->getNeurons($k)->derivativator(
                      $this->getNeurons($k)->output()),
                0);
       }
       $gr_sum[$j] = $sum;
      }
     for ($i = 0; $i < $this->numofneurons; $i++) {
      for ($n = 0; $n < $this->numofprevneurons; $n++) {
        $this->getNeurons($i)->setWeights(
              $n,
              ($this->getNeurons($i)->getWeights($n)+
               $this->learningrate*
               $this->getNeurons($i)->getInputs($n)*
               $this->getNeurons($i)->gradientor(
                    $errors[$i],
                    $this->getNeurons($i)->derivativator(
                         $this->getNeurons($i)->output()),
                    0)));
      }
     }  
     return $gr_sum;
    }
}