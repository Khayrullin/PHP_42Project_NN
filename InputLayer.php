<?php

class InputLayer {


    private $_trainset = array();
    private $_testset = array();

    public function __construct($nm) {
        $filename = $nm . "Set.png";
        $size = getimagesize($filename);
        $width = $size[0];
        $height = $size[1];
        $im = imagecreatefrompng($filename);

        switch ($nm) {
            case NetworkMode::Train: {
                    for ($y = 0; $y < ($height / 5); $y++) {
                        for ($x = 0; $x < ($width / 3); $x++) {
                            $this->_trainset[$x + $y * ($width / 3)][0] = array_fill(0, 15, null);
                            $this->_trainset[$x + $y * ($width / 3)][1] = (integer) $y;
                            for ($m = 0; $m < 5; $m++) {
                                for ($n = 0; $n < 3; $n++) {
                                    $this->_trainset[$x + $y * ($width / 3)][0][$n + 3 * $m] = (integer)
                                            ((imagecolorsforindex($im, imagecolorat($im, ($n + 3 * $x), ($m + 5 * $y)))["red"] +
                                            imagecolorsforindex($im, imagecolorat($im, ($n + 3 * $x), ($m + 5 * $y)))["green"] +
                                            imagecolorsforindex($im, imagecolorat($im, ($n + 3 * $x), ($m + 5 * $y)))["blue"]) / 765);
                                }
                            }
                        }
                    }

                    for ($n = (count($this->_trainset) - 1); $n >= 1; $n--) {
                        $j = rand(0, $n);
                        $temp = $this->_trainset[$n];
                        $this->_trainset[$n] = $this->_trainset[$j];
                        $this->_trainset[$j] = $temp;
                    }
                    break;
                }
            case NetworkMode::Test: {
                    for ($y = 0; $y < ($height / 5); $y++) {
                        for ($x = 0; $x < ($width / 3); $x++) {
                            $this->_testset[$x + $y * ($width / 3)][0] = array_fill(0, 15, null);
                            $this->_testset[$x + $y * ($width / 3)][1] = (integer) $y;
                            for ($m = 0; $m < 5; $m++) {
                                for ($n = 0; $n < 3; $n++) {
                                    $this->_testset[$x + $y * ($width / 3)][0][$n + 3 * $m] = (integer)
                                            ((imagecolorsforindex($im, imagecolorat($im, ($n + 3 * $x), ($m + 5 * $y)))["red"] +
                                            imagecolorsforindex($im, imagecolorat($im, ($n + 3 * $x), ($m + 5 * $y)))["green"] +
                                            imagecolorsforindex($im, imagecolorat($im, ($n + 3 * $x), ($m + 5 * $y)))["blue"]) / 765);
                                }
                            }
                        }
                    }
                    break;
                }
        }
    }

    public function getTrainset($key) {
        return $this->_trainset[$key];
    }

    public function getCountTrainset() {
        return count($this->_trainset);
    }

    public function getTestset($key) {
        return $this->_testset[$key];
    }

    public function getCountTestset() {
        return count($this->_testset);
    }

}
