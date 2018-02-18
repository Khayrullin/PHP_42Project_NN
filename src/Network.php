<?php

class Network
{
    const THRESHOLD = 0.001;
    public $fact = array(0, 0);

    function GetMSE($errors)
    {
        $sum = 0;
        for ($i = 0; $i < count($errors); ++$i)
            $sum += pow($errors[$i], 2);
        return 0.5 * $sum;
    }

    function GetCost($mses)
    {
        $sum = 0;
        for ($i = 0; $i < count($mses); ++$i)
            $sum += $mses[$i];
        return ($sum / count($mses));
    }

    static function Train($net)
    {
        $temp_cost = 0;
        do {
            for ($i = 0; $i < count($net->input_layer->Trainset); ++$i) {
                $net->hidden_layer->Data = $net->input_layer->Trainset[$i]->Item1;
                $net->hidden_layer->Recognize(null, $net->output_layer);
                $net->output_layer->Recognize($net, null);

                $errors = [];
                for ($x = 0; $x < count($net->input_layer->Trainset[$i]->Item2); ++$x)
                    $errors[$x] = $net->input_layer->Trainset[$i]->Item2[$x] - $net->fact[$x];
                $temp_mses[$i] = $net->GetMSE($errors);
                //обратный проход и коррекция весов
                $temp_gsums = $net->output_layer->BackwardPass($errors);
                $net->hidden_layer->BackwardPass($temp_gsums);
            }
            $temp_cost = $net->GetCost($temp_mses);//вычисление ошибки по эпохе
            //debugging
            echo $temp_cost;
        } while ($temp_cost > THRESHOLD);

        $net->hidden_layer->WeightInitialize('SET', nameof(hidden_layer));
        $net->output_layer->WeightInitialize('SET', nameof(output_layer));
    }

    static function Test($net)
    {
        for ($i = 0; $i < count($net->input_layer->Trainset); ++$i) {
            $net->hidden_layer->Data = $net->input_layer->Trainset[$i]->Item1;
            $net->hidden_layer->Recognize(null, $net->output_layer);
            $net->output_layer->Recognize($net, null);
            for ($j = 0; $j < count($net->fact); ++$j)
                var_dump($net->fact[j]);
            echo "\n";
        }
    }
}
