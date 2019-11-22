<?php  


if (isset($_POST["action"]) and $_POST["action"]=="insert_form"){
$insert = new database();
$insert->connect();
$insert->insert_form();
$insert->disconnect();
}
if (isset($_POST["action"]) and $_POST["action"]=="insert_data"){
$insert_data = new database();
$insert_data->connect();
$insert_data->insert();
$insert_data->disconnect();
}
if (isset($_POST["action"]) and $_POST["action"]=="delete_data"){
$delete_data = new database();
$delete_data->connect();
$delete_data->delete();
$delete_data->disconnect();
}
if (isset($_POST["action"]) and $_POST["action"]=="update_data"){
$update_data = new database();
$update_data->connect();
$update_data->fullupdate_form();
$update_data->disconnect();
}
if (isset($_POST["action"]) and $_POST["action"]=="fullupdate_data"){
$fullupdate_data = new database();
$fullupdate_data->connect();
$fullupdate_data->fullupdate_data();
$fullupdate_data->disconnect();
}
if (isset($_POST["action"]) and $_POST["action"]=="elerheto"){
$update_elerheto = new database();
$update_elerheto->connect();
$update_elerheto->update_elerheto();
$update_elerheto->disconnect();
}
if (isset($_POST["action"]) and $_POST["action"]=="nem_elerheto"){
$update_elerheto = new database();
$update_elerheto->connect();
$update_elerheto->update_nem_elerheto();
$update_elerheto->disconnect();
}

$select = new database();
$select->connect();
$select->insert_button();
$select->select();
$select->disconnect();


class database
        {
            public  $servername = "localhost";
            public  $username = "root";
            public  $password = "";
            public  $dbname = "webshop";
            public $conn = NULL;
            public $sql = NULL;
            public $result = NULL;
            public $row = NULL;

            public function connect()
            {
                $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
                if ($this->conn->connect_error) {
                    die("Connection failed: " . $this->conn->connect_error);
                }   
                $this->conn->query("SET NAMES 'UTF8';");
            }
            public function disconnect()
            {
                $this->conn->close();       
            }

            public function select()
            {
                $this->sql = "select * from kulacsok";
                $this->result = $this->conn->query($this->sql);
                if ($this->result->num_rows > 0) {
                while($this->row = $this->result->fetch_assoc()) {
                    echo '<p>Id: ' . $this->row["id"] . '</p>';
                    echo '<p>Név: ' . $this->row["nev"] . '</p>';
                    echo '<p>Márka: ' . $this->row["marka"] . '</p>';
                    echo '<p>Anyag: ' . $this->row["anyag"] . '</p>';
                    echo '<p>Szín: ' . $this->row["szin"] . '</p>';
                    echo '<p>Ár: ' . $this->row["ar"] . '</p>';
                        if ($this->row["raktaron"] == 0) {
                            echo '<p>Raktáron: Nincs raktáron</p>';
                        }
                        elseif ($this->row["raktaron"] == 1) {
                            echo '<p>Raktáron: Van raktáron</p>';
                        }
                    echo '<p>Elérhető: ' . $this->row["elerheto"] . '</p>';
                    echo "<form method='POST'>";
                        echo "<input type='hidden' name='action' value='delete_data'>";
                        echo "<input type='hidden' name='input_id' value='".$this->row["id"]."'>";
                        echo "<input type='submit' value='Törlés'>";
                    echo "</form>";
                    echo "<form method='POST'>";
                        echo "<input type='hidden' name='action' value='update_data'>";
                        echo "<input type='hidden' name='input_id' value='".$this->row["id"]."'>";
                        echo "<input type='submit' value='Modositas'>";
                    echo "</form>";
                    echo "<form method='POST'>";
                        echo "<input type='hidden' name='action' value='elerheto'>";
                        echo "<input type='hidden' name='input_id' value='".$this->row["id"]."'>";
                        echo "<input type='submit' value='Elerheto'>";
                    echo "</form>";
                    echo "<form method='POST'>";
                        echo "<input type='hidden' name='action' value='nem_elerheto'>";
                        echo "<input type='hidden' name='input_id' value='".$this->row["id"]."'>";
                        echo "<input type='submit' value='Nem elerheto'>";
                    echo "</form>";
                    echo "+------------------------------------------------------+";
                    }
                } else {
                    echo "0 results";
                }
            }
            public function insert_button()
            {
                ?>
                <form method="POST">
                    <input type="hidden" name="action" value="insert_form">
                    <input type="submit" value="Beszuras">
                </form>
                <?php
            }
            public function insert_form()
            {
                ?>
                <form method="POST">
                    Add meg a termék nevét:<br />
                    <input type="text" name="input_nev"><br />
                    Add meg a termék márkáját:<br />
                    <input type="text" name="input_marka"><br />
                    Add meg a termék anyagát:<br />
                    <input type="text" name="input_anyag"><br />
                    Add meg a termék színét:<br />
                    <input type="text" name="input_szin"><br />
                    Add meg a termék árát:<br />
                    <input type="number" name="input_ar"><br />
                    Add meg meddig legyen elerheto:
                    <input type="date" name="input_elerheto"><br />
                    Add meg, hogy a termék van-e raktáron:<br />
                    <input type="radio" name="input_raktaron" value="1">Raktaron
                    <input type="radio" name="input_raktaron" value="0">Nincs raktaron<br />
                    <input type="hidden" name="action" value="insert_data">
                    <input type="submit" value="Uj adat felvétele">
                </form>
                <?php
            }
            public function insert()
            {
                $this->sql = "INSERT INTO kulacsok (nev, marka, anyag, szin, ar, raktaron, elerheto) VALUES ( 
                    '". $_POST["input_nev"]."', 
                    '". $_POST["input_marka"]."', 
                    '". $_POST["input_anyag"]."', 
                    '". $_POST["input_szin"]."', 
                    ". $_POST["input_ar"].", 
                    ". $_POST["input_raktaron"].",
                    '". $_POST["input_elerheto"]."');";
                if($this->conn->query($this->sql)){
                    echo "Sikeres beszuras!<br />";
                } else {
                    echo "Sikertelen beszuras!<br />";
                }
            }
            public function delete()
            {
                $this->sql = "DELETE FROM kulacsok WHERE id = " . $_POST["input_id"] . ";";
                if($this->conn->query($this->sql)){
                    echo "Sikeres torles!<br />";
                } else {
                    echo "Sikertelen torles!<br />";
                }
            }
            public function fullupdate_form()
            {
                $this->sql = "select * from kulacsok WHERE id = ". $_POST["input_id"].";";
                $this->result = $this->conn->query($this->sql);
                if ($this->result->num_rows > 0) {
                    while($this->row = $this->result->fetch_assoc()) {
                    ?>
                    <form method="POST">
                        Add meg a termék nevét:<br />
                        <input type="text" name="input_nev" value="<?php echo $this->row["nev"]; ?>"><br />
                        Add meg a termék márkáját:<br />
                        <input type="text" name="input_marka" value="<?php echo $this->row["marka"]; ?>"><br />
                        Add meg a termék anyagát:<br />
                        <input type="text" name="input_anyag" value="<?php echo $this->row["anyag"]; ?>"><br />
                        Add meg a termék színét:<br />
                        <input type="text" name="input_szin" value="<?php echo $this->row["szin"]; ?>"><br />
                        Add meg a termék árát:<br />
                        <input type="number" name="input_ar" value="<?php echo $this->row["ar"]; ?>"><br />
                        Add meg meddig legyen elerheto:<br />
                        <input type="date" name="input_elerheto" value="<?php echo $this->row["elerheto"]; ?>"><br />
                        Add meg, hogy a termék van-e raktáron:<br />

                        <?php  
                        if ($this->row["raktaron"] == 1) {
                        ?>
                            <input type="radio" name="input_raktaron" value="1" checked>Raktaron
                            <input type="radio" name="input_raktaron" value="0">Nincs raktaron<br />
                        <?php
                        }
                        if ($this->row["raktaron"] == 0) {
                        ?>
                            <input type="radio" name="input_raktaron" value="1">Raktaron
                            <input type="radio" name="input_raktaron" value="0" checked>Nincs raktaron<br />
                        <?php
                        }
                        ?>
                        <input type="hidden" name="action" value="fullupdate_data">
                        <input type="hidden" name="input_id" value= "<?php echo $this->row["id"]; ?>">
                        <input type="submit" value="Modositas">
                    </form>
                    <?php
                    }
                }
            }

            public function fullupdate_data()
            {
                $this->sql = "UPDATE `kulacsok` SET 
                nev = '". $_POST["input_nev"]."', 
                marka = '". $_POST["input_marka"]."', 
                anyag = '". $_POST["input_anyag"]."', 
                szin = '". $_POST["input_szin"]."', 
                ar = ". $_POST["input_ar"].", 
                raktaron = ". $_POST["input_raktaron"].", 
                elerheto = '". $_POST["input_elerheto"]."' WHERE id = ". $_POST["input_id"].";";
                if($this->conn->query($this->sql)){
                    echo "Sikeres modositas!<br />";
                } else {
                    echo "Sikertelen modositas!<br />";
                }
            }

            public function update_elerheto()
            {
                $this->sql = "UPDATE `kulacsok` SET 
                raktaron = 1
                WHERE id = ". $_POST["input_id"].";";
                $this->conn->query($this->sql);
            }
            public function update_nem_elerheto()
            {
                $this->sql = "UPDATE `kulacsok` SET 
                raktaron = 0
                WHERE id = ". $_POST["input_id"].";";
                $this->conn->query($this->sql);
            }
        }
    ?>
