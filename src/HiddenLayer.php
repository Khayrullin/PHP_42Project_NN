<?php

class HiddenLayer extends Layer
{

    public function recognize(Network $net, Layer $nextLayer)
    {
        $hidden_out = array();
        for ($i = 0; $i < sizeof($this->neurons); ++$i) {
            $hidden_out[$i] = $this->neurons[$i]->output();
        }
        $nextLayer->setData($hidden_out);
    }

    public function backwardPass($gr_sums)
    {
        $gr_sum = null;
        //сюда можно всунуть вычисление градиентных сумм для других скрытых слоёв
        //но градиенты будут вычисляться по-другому, то есть
        //через градиентные суммы следующего слоя и производные
        for ($i = 0; $i < $this->numofneurons; ++$i) {
            for ($n = 0; $n < $this->numofprevneurons; ++$n) {
                $this->neurons[$i]->getWeights()[$n] += $this::LEARNINGRATE *
                    $this->neurons[$i]->getInputs()[$n] *
                    $this->neurons[$i]->gradientor(0, $this->neurons[$i]->derivativator($this->neurons[$i]->output),
                        $gr_sums[$i]);
            }
        }//коррекция весов
        return $gr_sum;
    }
}