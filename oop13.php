<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <form>
        <input type="text" name="input_karakterlanc">
        <input type="hidden" name="action" value="cmd_feldolgozas">
        <input type="submit" value="Küldés">
    </form>
</body>
</html>



<?php

if (isset($_GET["action"]) and $_GET["action"]=="cmd_feldolgozas"){
    if(isset($_GET["input_karakterlanc"]) and is_string($_GET["input_karakterlanc"])
    and strlen($_GET["input_karakterlanc"]) >= 25 and strlen($_GET["input_karakterlanc"]) <= 200){
        $mondat = new Stringek($_GET["input_karakterlanc"]);
            $mondat->make_first_words_uppercase();
            $mondat->charcount();
            $mondat->wordcount();
        echo $mondat->get_karakterlanc() . "<br />";
        echo $mondat->get_hossz() . " karakter<br />";
        echo $mondat->get_szavak() . " szó";
    }
}

class Stringek
{
    private $karakterlanc;
    private $hossz = 0;
    private $szavak = 0;
    public function set_karakterlanc($ertek)
    {
        $this->karakterlanc = $ertek;
    }
    public function __construct($karakterlanc_)
    {
        self::set_karakterlanc($karakterlanc_);
    }
    public function make_first_words_uppercase()
    {
        $this->karakterlanc = ucwords($this->karakterlanc);
    }
    public function charcount()
    {
        $this->hossz = strlen($this->karakterlanc);
    }
    public function wordcount()
    {
        $this->szavak = str_word_count($this->karakterlanc);
    }
    public function get_karakterlanc()
    {
        return $this->karakterlanc;
    }
    public function get_hossz()
    {
        return $this->hossz;
    }
    public function get_szavak()
    {
        return $this->szavak;
    }
}






?>