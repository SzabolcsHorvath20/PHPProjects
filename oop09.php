<?php

$feladat_1 = new randoms();
    $feladat_1-> rnd_1 = rand(-10,10);
    $feladat_1-> rnd_2 = rand(-10,10);
    $feladat_1-> compare();






class randoms
{
    public $rnd_1;
    public $rnd_2;
    public function compare()
    {
        if ($this->rnd_1 > $this->rnd_2) {
            echo "A második szám a nagyobb.";
        }
        elseif ($this->rnd_1 < $this->rnd_2) {
            echo "Az első szám a nagyobb";
        }
        else
        {
            echo "A két szám egyenlő.";
        }
    }

}
class relation
{
    public $rnd_1;
    public $rnd_2;
    public function compare()
    {
        if ($this->rnd_1 > $this->rnd_2) {
            echo $this->rnd_1 . " nagyobb, mint " . $this->rnd_2;
        }
        elseif ($this->rnd_1 < $this->rnd_2) {
            echo $this->rnd_1 . " kisebb, mint " . $this->rnd_2;
        }
        else
        {
            echo $this->rnd_1 . " egyenlő " . $this->rnd_2;
        }
    }
}





?>