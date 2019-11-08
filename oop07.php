<?php
    $PozNegNull = new elojel();
        $PozNegNull->szam = rand(-5,5);
        if ($PozNegNull->szam>0) {
            echo "<h1>Pozitív</h1>";
        }
        elseif ($PozNegNull->szam<0) {
            echo "<h1>Negatív</h1>";
        }
        else{
            echo "<h1>Nulla</h1>";
        }

    class elojel{
        public $szam;
    }
?>