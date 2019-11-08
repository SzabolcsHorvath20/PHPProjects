<?php
$cycles = new cycles_class();
    $cycles->set_i(0);
    $cycles->for_cycle();
    $cycles->set_i(2);
    $cycles->for_cycle();




class cycles_class
{
    private $i;
    public function set_i($ertek)
    {
        $this->i = $ertek;
    }
    public function get_i()
    {
        return $this->szam;
        echo szam;
    }
    public function for_cycle()
    {
        for ($this->i; $this->i < 5; $this->i++) { 
            echo $this->i . " ";
        }
    }
}




?>