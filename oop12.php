<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <form>
        <input type="text" name="input_csaladnev"><br />
        <input type="text" name="input_utonev"><br />
        <input type="number" name="input_kor"><br />
        <input type="hidden" name="action" value="cmd_feldolgozas">
        <input type="submit" name="Küldés">
    </form>
    <?php
if (isset($_GET["action"]) and $_GET["action"]=="cmd_feldolgozas"){
    if(isset($_GET["input_csaladnev"]) and is_string($_GET["input_csaladnev"]) and
        isset($_GET["input_utonev"]) and is_string($_GET["input_utonev"]) and
        isset($_GET["input_kor"]) and is_numeric($_GET["input_kor"]) and 
        ($_GET["input_kor"] > 0)){
        $szemelyek = new Szemely($_GET["input_csaladnev"],$_GET["input_utonev"],$_GET["input_kor"]);
        echo $szemelyek->get_szemely();
    }
}
?>
</body>
</html>
<?php

class Szemely
{
    private $csaladnev;
    private $utonev;
    private $kor = 0;
    private $osszefuzott;

    public function set_csaladnev($ertek)
    {
        $this->csaladnev = $ertek;
    }
    public function set_utonev($ertek)
    {
        $this->utonev = $ertek;
    }
    public function set_kor($ertek)
    {
        $this->kor = $ertek;
    }
    public function get_szemely()
    {
        return $this->osszefuzott;
    }


    public function __construct($csaladnev_, $utonev_, $kor_)
    {
        self::set_csaladnev($csaladnev_);
        self::set_utonev($utonev_);
        self::set_kor($kor_);
        $this->osszefuzott = $this->csaladnev . " " . $this->utonev . " " . $this->kor;
    }
}

?>