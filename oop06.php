<?php
    $geometria = new negyzet();
        $geometria->oldal = rand(1,10);
        $geometria->kiir();
        
    class negyzet{
        public $oldal;
        public function kiir(){
            echo "Oldal  : " . ($this->oldal) . "</br>";
            echo "Kerület: " . ($this->oldal*4) . "</br>";
            echo "Terület: " . ($this->oldal*$this->oldal);

        }
    }
?>