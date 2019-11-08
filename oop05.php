<?php 

$pisti = new szemelyek();
$pisti->nev = "Istvan";
$pisti->kor = 18;
echo "Pisti hivatalos formája: " . $pisti->nev;

class szemelyek{
    public $nev;
    public $kor;

}






?>