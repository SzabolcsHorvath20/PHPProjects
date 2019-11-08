<?php

    echo "0.Feladat<br />";
$tombos_feladat1 = new tombok();
    $tombos_feladat1->feltoltes();
    $tombos_feladat1->kiiratas();
    echo "<br />1.Feladat<br />";
$tombos_feladat2 = new tombok2();
    $tombos_feladat2->feltoltes();
    $tombos_feladat2->megszamlalas();
    $tombos_feladat2->kiiratas();
    echo "A tömb hossza: " . $tombos_feladat2->get_tombhossz();
    echo "<br />2.Feladat<br />";
$tombos_feladat3 = new tombok3();
    $tombos_feladat3->feltoltes();
    $tombos_feladat3->megszamlalas();
    $tombos_feladat3->kiiratas();
    echo "<br />";
    echo "A tömb hossza: " . $tombos_feladat3->get_tombhossz();
    echo "<br />";
    $tombos_feladat3->osszegzes();
    echo "A tömb elemeinek összege: " . $tombos_feladat3->get_tombosszeg();

class tombok
{
    private $tomb;
    public function feltoltes()
    {
        for ($i=0; $i < 10; $i++) { 
            $this->tomb[$i]=rand(-10,10);
        }
    }
    public function kiiratas()
    {
        for ($i=0; $i < 10; $i++) { 
            echo $this->tomb[$i] . ", ";
        }
    }

}

class tombok2
{
    private $tomb2;
    private $tombhossz = 0;
    public function set_tombhossz($ertek)
    {
            $this->tombhossz = $ertek;
    }
    public function get_tombhossz()
    {
        return $this->tombhossz;
    }
    public function feltoltes()
    {
        for ($i=0; $i < 5; $i++) { 
            $this->tomb2[$i]=rand(1,100);
        }
    }
    public function megszamlalas()
    {
        foreach ($this->tomb2 as $value) {
            $this->tombhossz++;
        }
    }
    public function kiiratas()
    {
        for ($i=0; $i < 5; $i++) { 
            echo $this->tomb2[$i] . ", ";
        }
    }
}

class tombok3
{
    private $tomb3;
    private $tombhossz3 = 0;
    private $tombosszeg3 = 0;
    public function set_tombhossz($ertek)
    {
            $this->tombhossz3 = $ertek;
    }
    public function get_tombhossz()
    {
        return $this->tombhossz3;
    }
    public function set_tombosszeg($ertek)
    {
            $this->tombosszeg3 = $ertek;
    }
    public function get_tombosszeg()
    {
        return $this->tombosszeg3;
    }
    public function feltoltes()
    {
        for ($i=0; $i < 100; $i++) { 
            $this->tomb3[$i] = rand(1,200);
        }
    }
    public function megszamlalas()
    {
        foreach ($this->tomb3 as $value) {
            $this->tombhossz3++;
        }
    }
    public function kiiratas()
    {
        foreach ($this->tomb3 as $value) {
            echo $value . ", ";
        }
    }
    public function osszegzes(){
        foreach ($this->tomb3 as $value) {
            $this->tombosszeg3+=$value;
        }
    }
}

?>