<?php

if (isset($_GET["action"]) and $_GET["action"]=="select2"){
$select2 = new database();
$select2-> select2();
$select2-> select3();
echo "----------------------------------------------------------------------------------------------------------------------------------------------------------------";
}

$select1 = new database();
$select1-> select2_form();
$select1-> select1();
echo "---------------------------------------------------------------------------";


class database
        {
            public  $servername = "localhost";
            public  $username = "root";
            public  $password = "";
            public  $dbname = "classicmodels";
            public $conn = NULL;
            public $sql = NULL;
            public $result = NULL;
            public $row = NULL;

            public function __construct()
            {
                self::connect();
            }
            public function __destruct()
            {
                self::disconnect();
            }

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

            public function select1()
            {
                $this->sql = "SELECT productCode, productName, buyPrice FROM products WHERE buyPrice BETWEEN 90 AND 100 ";
                $this->result = $this->conn->query($this->sql);
                if ($this->result->num_rows > 0) {
                while($this->row = $this->result->fetch_assoc()) {
                    echo '<p>Product name: ' . $this->row["productName"] . '</p>';
                    echo '<p>Product price: ' . $this->row["buyPrice"] . '</p>';


                    }
                } else {
                    echo "0 results";
                }
            }

            public function select2_form()
            {
                ?>
                <form method="GET">
                    <input type="number" name="inputOrderNumber">
                    <input type="hidden" name="action" value="select2">
                    <input type="Submit" value="Lekérés">
                </form>
                <?php
            }

            public function select2()
            {
                $this->sql = "SELECT orderNumber, orderDate FROM orders WHERE orderNumber = " . $_GET["inputOrderNumber"];
                $this->result = $this->conn->query($this->sql);
                if ($this->result->num_rows > 0) {
                while($this->row = $this->result->fetch_assoc()) {
                    echo '<p>Order number: ' . $this->row["orderNumber"] . '</p>';
                    echo '<p>Order date: ' . $this->row["orderDate"] . '</p>';
                    }
                } else {
                    echo "0 results";
                }
            }
            public function select3()
            {
                $this->sql = "SELECT od.orderNumber, 
                                     od.productCode, 
                                     p.productName,
                                     od.quantityOrdered, 
                                     od.priceEach, 
                                     od.orderLineNumber 
                FROM orderdetails od 
                INNER JOIN orders o ON o.orderNumber = od.orderNumber
                INNER join products p ON p.productCode = od.productCode
                WHERE od.orderNumber = " . $_GET["inputOrderNumber"];
                $this->result = $this->conn->query($this->sql);
                if ($this->result->num_rows > 0) {
                    echo "<table>";
                        echo '<tr>';
                            echo '<th>Order number</th>';
                            echo '<th>Product code</th>';
                            echo '<th>Product name</th>';
                            echo '<th>Quantity ordered</th>';
                            echo '<th>Price each</th>';
                            echo '<th>Order line number</th>';
                        echo '</tr>';
                while($this->row = $this->result->fetch_assoc()) {
                    echo '<tr>';
                        echo '<td>' . $this->row["orderNumber"] . '</td>';
                        echo '<td>' . $this->row["productCode"] . '</td>';
                        echo '<td>' . $this->row["productName"] . '</td>';
                        echo '<td>' . $this->row["quantityOrdered"] . '</td>';
                        echo '<td>' . $this->row["priceEach"] . '</td>';
                        echo '<td>' . $this->row["orderLineNumber"] . '</td>';
                    echo '</tr>';
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }
            }
        }




             ?>