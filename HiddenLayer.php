<?php

class HiddenLayer extends Layer {

    public function recognize($net, $nextLayer) {
        $hidden_out = array();
        for ($i = 0; $i < $this->numofneurons; $i++) {
            $hidden_out[$i] = $this->getNeurons($i)->getOutput();
        }
        $nextLayer->setData($hidden_out);
    }

    public function backwardPass(array $gr_sums) {
        $gr_sum = array();
        for ($j = 0; $j < $this->numofprevneurons; $j++) {
            $sum = 0;
            for ($k = 0; $k < $this->numofneurons; $k++) {
                $sum = $sum +
                        $this->getNeurons($k)->getWeights($j) *
                        $this->getNeurons($k)->getDerivative() *
                        $gr_sums[$k];
            }
            $gr_sum[$j] = $sum;
        }


        for ($i = 0; $i < $this->numofneurons; $i++) {
            for ($n = 0; $n < $this->numofprevneurons + 1; $n++) {
                $deltaw = ($n == 0) ?
                        ($this->momentum * $this->lastdeltaweights[$i][0] +
                        $this->learningrate * $this->getNeurons($i)->getDerivative() * $gr_sums[$i]) :
                        ($this->momentum * $this->lastdeltaweights[$i][$n] +
                        $this->learningrate * $this->getNeurons($i)->getInputs($n - 1) * $this->getNeurons($i)->getDerivative() * $gr_sums[$i]);
                $this->lastdeltaweights[$i][$n] = $deltaw;
                $this->getNeurons($i)->setWeights($n, ($this->getNeurons($i)->getWeights($n) + $deltaw));
            }
        }
        return $gr_sum;
    }

}
