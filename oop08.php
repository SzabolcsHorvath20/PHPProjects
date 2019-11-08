<?php 
$cycles = new cycles_class();
    $cycles->i = 0;
    $cycles->for_cycle();
    echo "</br>";
    $cycles->i = 0;
    $cycles->dowhile_cycle();
    echo "</br>";
    $cycles->i = 0;
    $cycles->while_cycle();
    echo "</br>";
    $cycles->i = 0;
    $cycles->for_cycle_css();
$cyclesionhasdgfoihafs = new cycles_class();
    $cyclesionhasdgfoihafs->i = 3;
    $cyclesionhasdgfoihafs->for_cycle_css();

class cycles_class
{
    public $i;
    function for_cycle()
    {
        for ($this->i; $this->i < 5; $this->i++) { 
            echo $this->i . " ";
        }
    }
    function dowhile_cycle()
    {
        do {
            echo $this->i . " ";
            $this->i++;
        } while ($this->i < 5);
    }
    function while_cycle()
    {
        while ($this->i < 5) {
            echo $this->i . " ";
            $this->i++;
        }
    }
    function for_cycle_css()
    {
        echo "<table style='border: 1px solid red;'>";
        for ($this->i; $this->i < 5; $this->i++) { 
            echo "<tr>";
                echo "<td>";
                    echo $this->i;
                echo "</td>";
                echo "<td>";
                    echo ($this->i*2);
                echo "</td>";           
            echo "</tr>";
        }
        echo "</table>";
    }

}
 ?>