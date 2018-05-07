<?php

class InitRandWeights {

    private $fp;
    private $non;
    private $nopn;
    private $base = 100;
    private $start = -1;
    private $stop = 1;

    public function __construct($non, $nopn, $name) {
        $this->non = $non;
        $this->nopn = $nopn;
        $name = $name . "_memory.xml";
        $this->fp = fopen("$name", "w");
        $this->generate();
        fclose($this->fp);
    }

    public function generate() {
        $string1 = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        fwrite($this->fp, $string1);
        $string2 = "<weights>\n";
        fwrite($this->fp, $string2);
        for ($i = 0; $i < ($this->non * ($this->nopn + 1)); $i++) {
            $rnd = mt_rand(($this->start * $this->base), ($this->stop * $this->base)) / $this->base;
            $string = "  <weight>" . $rnd . "</weight>\n";
            fwrite($this->fp, $string);
        }
        $string3 = "</weights>\n";
        fwrite($this->fp, $string3);
    }

}
