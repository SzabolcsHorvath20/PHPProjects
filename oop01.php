<?php
$time = new basic();
    $time->p_start();
    $time->ido();
    $time->p_stop();

class basic{
    public function p_start()
    {
        echo "<p>";
    }
    public function p_stop()
    {
        echo "</p>";
    }
    public function ido()
    {
        echo date("H:i:s");
    }
}



?>