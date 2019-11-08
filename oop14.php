<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style>
        table, th, td {
            border-style: solid; border-color: #000000; border-collapse: collapse;
        }

        tr:nth-child(even){
        background: #dad5f4;
        }
</style>

    </style>
</head>
<body>
<?php

class dbManager
{
    private $username = "root";
    private $password = "";
    private $dbname = "webshop";
    private $servername = "localhost";
    public function connect()
    {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) 
        {
        die("fail".$this->conn->connect_error);
        }
    }
    public function close()
    {
        $this->conn->close();
    }
    public function delete($id)
    {
        if (isset($_GET["action"]) and $_GET["action"] == "delete") {
            $query = "DELETE * from products where id = " . $id;
            echo $query;
    }
}
    public function query()
    {
        echo '<table>';
            echo '<tr>';
                echo '<th>Id</th>';
                echo '<th>Name</th>';
                echo '<th>Description</th>';
                echo '<th>Price</th>';
                echo '<th>Picture</th>';
                echo '<th>Delete</th>';
            echo '</tr>';
        $legnagyobb = 0;
        $legkisebb = 2147483647;
        $atlag;
        $atlagseged = 0;
        $sql = "select * from products";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                echo '<td>' . $row["id"] . '</td>';
                echo '<td>' . $row["prod_title"] . '</td>'; 
                echo '<td>' . $row["prod_desc"] . '</td>';
                if ($row["prod_price"] <= 2000) {
                    echo '<td>' . $row["prod_price"] . 'Ft' . '</td>';
                }
                else
                {
                    echo '<td style = "color:red; font-weight: bold;">' . $row["prod_price"] . 'Ft' . '</td>';
                }
                echo '<td>' . '<img src="'.$row["prod_picture"].'" style = "width: 100px; height: 100px;"/>'  .'</td>';
                echo '<td><form><input type = "submit" value = "delete"><input type = "hidden" value = "delete" name = "action"><input type = "hidden" name = "id" value = '.$row["id"].'</from></td>';
            echo '</tr>';
    }
    } else {
        echo "0 results";
    }
        }
    }
            echo '</table>';
    
    
$dbInstance = new dbManager();
    $dbInstance->connect();
    $dbInstance->query();
    if (isset($_GET["action"]) and $_GET["action"]=="delete"){
        $dbInstance->delete($_GET["id"]);
    }
    $dbInstance->close();
?>
</body>
</html>






























