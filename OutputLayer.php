<?php

class OutputLayer extends Layer {

    public function recognize($net, $nextLayer) {
        $e_sum = 0;
        for ($i = 0; $i < $this->numofneurons; $i++) {
            $e_sum = $e_sum + $this->getNeurons($i)->getOutput();
        }
        for ($i = 0; $i < $this->numofneurons; $i++) {
            $net->fact[$i] = $this->getNeurons($i)->getOutput() / $e_sum;
        }
    }

    public function backwardPass(array $errors) {
        $gr_sum = array();
        for ($j = 0; $j < ($this->numofprevneurons + 1); $j++) {
            $sum = 0;
            for ($k = 0; $k < $this->numofneurons; $k++) {
                $sum +=
                        $this->getNeurons($k)->getWeights($j) *
                        $errors[$k];
            }
            $gr_sum[$j] = $sum;
        }
        for ($i = 0; $i < $this->numofneurons; $i++) {
            for ($n = 0; $n < ($this->numofprevneurons + 1); $n++) {
                $deltaw = ($n == 0) ?
                        ($this->momentum * $this->lastdeltaweights[$i][0] +
                        $this->learningrate * $errors[$i]) :
                        ($this->momentum * $this->lastdeltaweights[$i][$n] +
                        $this->learningrate * $this->getNeurons($i)->getInputs($n - 1) * $errors[$i]);
                $this->lastdeltaweights[$i][$n] = $deltaw;
                $this->getNeurons($i)->setWeights($n, ($this->getNeurons($i)->getWeights($n) + $deltaw));
            }
        }
        return $gr_sum;
    }

}
