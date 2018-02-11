<?php

class OutputLayer extends Layer
{



    public function recognize(Network $net, Layer $nextLayer)
    {
        for ($i = 0; $i < sizeof($this->neurons); ++$i)
                $net->fact[$i] = $this->neurons[$i]->output();
    }

    public function backwardPass($errors)
    {
        $gr_sum = array();
            for ($j = 0; $j < $this->numofprevneurons; ++$j)//вычисление градиентных сумм выходного слоя
            {
                $sum = 0;
                for ($k = 0; $k < sizeof($this->neurons); ++$k)
                    $sum += $this->neurons[$k]->getWeights()[$j] *
                        $this->neurons[$k]->gradientor($errors[$k],
                            $this->neurons[$k]->derivativator(
                                $this->neurons[$k]->output()), 0);

                $gr_sum[$j] = $sum;
            }
            for ($i = 0; $i < $this->numofneurons; ++$i)
                for ($n = 0; $n < $this->numofprevneurons; ++$n)
                    $this->neurons[$i]->getWeights()[$n] += $this::LEARNINGRATE *
                        $this->neurons[$i]->getInputs()[$n]
                        * $this->neurons[$i]->gradientor($errors[$i],
                            $this->neurons[$i]->derivativator($this->neurons[$i]->output()), 0);
            return $gr_sum;
    }
}