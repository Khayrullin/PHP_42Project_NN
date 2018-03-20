<?php
require_once "C:\Users\habar\PhpstormProjects\PHP_Photo_colouring_NN\src\Layer.php";

class OutputLayer extends Layer
{


    public function recognize($net, $nextLayer)
    {
        for ($i = 0; $i < sizeof($this->neurons); ++$i) {
            $net->fact[$i] = $this->neurons[$i]->output();
        }
    }

    public function backwardPass($errors)
    {
        $gr_sum = array();
        for ($j = 0; $j < $this->numofprevneurons; ++$j) {
            $sum = 0;
            for ($k = 0; $k < sizeof($this->neurons); ++$k) {
                $sum += $this->neurons[$k]->getWeights()[$j] *
                    $this->neurons[$k]->gradientor($errors[$k],
                        $this->neurons[$k]->derivativator(
                            $this->neurons[$k]->output()), 0);
            }

            $gr_sum[$j] = $sum;
        }

        for ($i = 0; $i < $this->numofneurons; ++$i) {
            $narr = $this->neurons[$i]->getWeights();
            for ($n = 0; $n < $this->numofprevneurons; ++$n) {
                $narr[$n] += $this::LEARNINGRATE *
                    $this->neurons[$i]->getInputs()[$n]
                    * $this->neurons[$i]->gradientor($errors[$i],
                        $this->neurons[$i]->derivativator($this->neurons[$i]->output()), 0);
            }
            $this->neurons[$i]->setWeights($narr);
        }
        return $gr_sum;
    }
}