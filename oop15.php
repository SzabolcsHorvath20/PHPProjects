<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <?php

    if (isset($_POST["action"]) and $_POST["action"]=="update_termek_form"){
    $update_form = new database();
    $update_form->connect();
    $update_form->update_form();
    $update_form->disconnect();
    }
    if (isset($_POST["action"]) and $_POST["action"]=="update_termek"){
    $update_user = new database();
    $update_user->connect();
    $update_user->update_termek();
    $update_user->disconnect();            
    }

    $listazas = new database();
    $listazas->connect();
    $listazas->select();
    $listazas->disconnect();
        class database
        {
            public  $servername = "localhost";
            public  $username = "root";
            public  $password = "";
            public  $dbname = "zoldseges";
            public $conn = NULL;
            public $sql = NULL;
            public $result = NULL;
            public $row = NULL;

            public function connect(){
                $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
                if ($this->conn->connect_error) {
                    die("Connection failed: " . $this->conn->connect_error);
                }   
                $this->conn->query("SET NAMES 'UTF8';");
            }
            public function disconnect(){
                $this->conn->close();       
            }

            public function select()
            {
                $this->sql = "select * from termekek";
                $this->result = $this->conn->query($this->sql);
                if ($this->result->num_rows > 0) {
                while($this->row = $this->result->fetch_assoc()) {
                    echo '<p>Id: ' . $this->row["id"] . '</p>';
                    echo '<p>Név: ' . $this->row["nev"] . '</p>';
                    echo '<p>Ár: ' . $this->row["ar"] . '</p>';
                        if ($this->row["elerhetoseg"] == 0) {
                            echo '<p>Raktáron: Nincs raktáron</p>';
                        }
                        elseif ($this->row["elerhetoseg"] == 1) {
                            echo '<p>Raktáron: Van raktáron</p>';
                        }
                        echo "<form method='POST'>";
                        echo "<input type='hidden' name='action' value='update_termek_form'>";
                        echo "<input type='hidden' name='input_id' value='".$this->row["id"]."'>";
                        echo "<input type='submit' value='Módosítás'>";
                    echo "</form>";
                    echo "+------------------------------------------------------+";
                    }
                } else {
                    echo "0 results";
                }
            }
            public function update_termek(){
            $this->sql = "UPDATE 
                            termekek
                          SET
                            `nev`='".$_POST["input_nev"]."',
                            `ar`=".$_POST["input_ar"].",
                            `elerhetoseg` =".$_POST["input_elerhetoseg"]."
                          WHERE
                             `id` = ". $_POST["input_id"]."
                                ;";
                if($this->conn->query($this->sql)){
                    echo "Sikeres adatmódosítás!<br />";
                } else {
                    echo "Sikertelen adatmódosítás!<br />";
                }       
            }
            public function update_form(){
        $this->sql = "SELECT * FROM termekek WHERE id = ". $_POST["input_id"].";";
        $this->result = $this->conn->query($this->sql);
        if ($this->result->num_rows > 0) {
            while($this->row = $this->result->fetch_assoc()) {
                ?>
                    <h1>Módosítás</h1>
                    <form method="POST">
                        Add meg a termék nevét <br />
                        <input type="text" name="input_nev"
                            value="<?php echo $this->row["nev"]; ?>"><br />
                        Add meg az új árat: <br />
                        <input type="number" name="input_ar"
                            value="<?php echo $this->row["ar"]; ?>"><br />
                        <?php  
                        if ($this->row["elerhetoseg"] == 1) {?>
                            <input type="radio" name="input_elerhetoseg" value="1" checked>Raktáron
                            <input type="radio" name="input_elerhetoseg" value="0">Nincs raktáron<br />
                        <?php
                        }
                        if ($this->row["elerhetoseg"] == 0) {?>
                            <input type="radio" name="input_elerhetoseg" value="1">Raktáron
                            <input type="radio" name="input_elerhetoseg" value="0" checked>Nincs raktáron<br />
                        <?php
                        }
                        ?>
                        <input type="hidden" name="input_id" 
                            value="<?php echo  $this->row["id"]; ?>">
                        <input type="hidden" name="action" value="update_termek">
                        <input type="submit" value="Módosítás végrehajtása">
                    </form>                         
                    <?php
                }
            } else {
                echo "0 results";
            }  
        }
    }
        ?>





</body>
</html>