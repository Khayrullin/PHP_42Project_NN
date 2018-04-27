<?php
require_once "C:\Users\habar\PhpstormProjects\PHP_Photo_colouring_NN\src\Layer.php";

class HiddenLayer extends Layer
{

    public function recognize($net, $nextLayer)
    {
        $hidden_out = array();
        for ($i = 0; $i < $this->numofneurons; $i++) {
            $hidden_out[$i] = $this->getNeurons($i)->output();
        }
        $nextLayer->setData($hidden_out);
    }

    public function backwardPass($gr_sums)
    {
        $gr_sum = null;
        for ($j = 0; $j < count($gr_sum); ++$j) {
            $sum = 0;
            for ($k = 0; $k < $this->numofneurons; ++$k) {
                $sum += $this->getNeurons($k)->getWeights($j) *
                    $this->getNeurons($k)->getDerivative() *
                    $gr_sums[$k];
            }//через градиентные суммы и производную
            $gr_sum[$j] = $sum;
        }
        for ($i = 0; $i < $this->numofneurons; $i++) {
            for ($n = 0; $n < $this->numofprevneurons; $n++) {
                $deltaw = ($n == 0) ?
                    (
                        $this->momentum *
                        $this->lastdeltaweights[$i][0] +
                        $this->learningrate *
                        $this->getNeurons($i)->getDerivative() *
                        $gr_sums[$i]
                    ) : (
                        $this->momentum *
                        $this->lastdeltaweights[$i][$n] +
                        $this->learningrate *
                        $this->getNeurons($i)->getInputs($n - 1) *
                        $this->getNeurons($i)->getDerivative() *
                        $gr_sums[$i]
                    );
                $this->lastdeltaweights[$i][$n] = $deltaw;
                $this->getNeurons($i)->setWeights($n, $this->getNeurons($i)->getWeights($n) + $deltaw);
            }
        }
        return $gr_sum;
    }
}