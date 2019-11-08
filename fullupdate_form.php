<form method="POST">
	<input type="hidden" name="action" value="cmd_insert_user_form">
	<input type="submit" value="Felvétel űrlap megjelenítése">
</form>	
		


<?php

echo "<pre>"; var_dump($_POST); echo "</pre>";

if (isset($_POST["action"]) and $_POST["action"]=="cmd_update_user_form"){
	$update_form = new adatbazis();
	$update_form->kapcsolodas();
	$update_form->update_form();
	$update_form->kapcsolatbontas();		
}
if (isset($_POST["action"]) and $_POST["action"]=="cmd_update_user"){
	$update_user = new adatbazis();
	$update_user->kapcsolodas();
	$update_user->cmd_update_user();
	$update_user->kapcsolatbontas();		
}
if (isset($_POST["action"]) and $_POST["action"]=="cmd_insert_user_form"){
	$insert = new adatbazis();
	$insert->kapcsolodas();
	$insert->insert_user_form();
	$insert->kapcsolatbontas();	
}
if (isset($_POST["action"]) and $_POST["action"]=="cmd_insert_user"){
	$insert = new adatbazis();
	$insert->kapcsolodas();
	$insert->insert_blog();
	$insert->kapcsolatbontas();	
}

$blog = new adatbazis();
$blog->kapcsolodas();
$blog->select_blog();
$blog->kapcsolatbontas();

class adatbazis{
	public	$servername = "localhost";
	public	$username = "root";
	public	$password = "";
	public	$dbname = "adattar";
	public $conn = NULL;
	public $sql = NULL;
	public $result = NULL;
	public $row = NULL;
	
	public function kapcsolodas(){

		// Create connection
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		// Check connection
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		}	
		$this->conn->query("SET NAMES 'UTF8';");
	}
	public function insert_user_form(){
		?>
		<h1>Felvétel űrlap</h1>
		<form method="POST">
			Add meg a felhasználóneved: <br />
			<input type="text" name="input_user_username"><br />
			Add meg a jelszavad: <br />
			<input type="password" name="input_user_password"><br />
			Add meg a emailed: <br />
			<input type="email" name="input_user_email"><br />		
			Add meg a jogosultság: <br />	
			<select name="input_user_perm">
				<option value='user'>user</option>
				<option value='admin'>admin</option>
				<option value='moderator'>moderator</option>
			</select><br />	
			Add meg a aktivitást: <br />	
			<select name="input_user_activity">
				<option value='1'>Aktív</option>
				<option value='0' selected>Inaktív</option>
			</select><br />	
			<input type="hidden" name="action" value="cmd_insert_user">
			<input type="submit" value="Felvétel">
		</form>			
		<?php
	}
	public function update_form(){
		//echo "Módosítandó sor: " . $_POST["input_id"] . "<br />";
		$this->sql = "SELECT 
					`user_id`, 
					`user_username`, 
					`user_email`, 
					`user_perm`, 
					`user_activity`, 
					`user_credit` 
				FROM 
					`users`
				WHERE
					`user_id` = ". $_POST["input_id"].";
					";
		$this->result = $this->conn->query($this->sql);

		if ($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
					//echo $this->row["user_id"] . ".: ";
					//echo $this->row["user_email"];
					?>
					<h1>Módosítás űrlap</h1>
					<form method="POST">
						Add meg a felhasználóneved: <br />
						<input type="text" name="input_user_username"
							value="<?php echo $this->row["user_username"]; ?>"><br />
						Add meg a emailed: <br />
						<input type="email" name="input_user_email"
							value="<?php echo $this->row["user_email"]; ?>"><br />		
						<!--
						Add meg a jogosultság: <br />	
						<select name="input_user_perm">
							<option value='user'>user</option>
							<option value='admin'>admin</option>
							<option value='moderator'>moderator</option>
						</select><br />	
						Add meg a aktivitást: <br />	
						<select name="input_user_activity">
							<option value='1'>Aktív</option>
							<option value='0' selected>Inaktív</option>
						</select><br />	
						-->
						<input type="hidden" name="input_id" 
							value="<?php echo  $this->row["user_id"]; ?>">
						<input type="hidden" name="action" value="cmd_update_user">
						<input type="submit" value="Módosítás végrehajtása">
					</form>							
					<?php
			}
		} else {
			echo "0 results";
		}				

	}
	public function cmd_update_user(){
		$this->sql = "UPDATE 
						users
					  SET
						`user_username`='".$_POST["input_user_username"]."',
						`user_email`='".$_POST["input_user_email"]."' 
					  WHERE
					     `user_id` = ". $_POST["input_id"]."
							;";
		if($this->conn->query($this->sql)){
			echo "Sikeres adatmódosítás!<br />";
		} else {
			echo "Sikertelen adatmódosítás!<br />";
		}		
	}
	
	public function select_blog(){
		$this->sql = "SELECT 
					`user_id`, 
					`user_username`, 
					`user_password`, 
					`user_email`, 
					`user_perm`, 
					`user_activity`, 
					`user_credit` 
				FROM 
					`users`";
		$this->result = $this->conn->query($this->sql);

		if ($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
				echo "<p>";
					echo $this->row["user_id"] . ".: ";
					echo $this->row["user_email"];
					echo "<form method='POST'>";
						echo "<input type='hidden' name='action' value='cmd_update_user_form'>";
						echo "<input type='hidden' name='input_id' value='".$this->row["user_id"]."'>";
						echo "<input type='submit' value='Módosítás'>";
					echo "</form>";
				echo "</p>";
			}
		} else {
			echo "0 results";
		}		
	}
	public function insert_blog(){
		$this->sql = "INSERT INTO 
						users
							(
							`user_id`, 
							`user_username`, 
							`user_password`, 
							`user_email`, 
							`user_perm`, 
							`user_activity`, 
							`user_credit` 
							)
						VALUES
							(
							NULL,
							'".$_POST["input_user_username"]."',
							'".$_POST["input_user_password"]."',
							'".$_POST["input_user_email"]."',
							'".$_POST["input_user_perm"]."',
							".$_POST["input_user_activity"].",
							0
							)
							";
		if($this->conn->query($this->sql)){
			echo "Sikeres adatfelvétel!<br />";
		} else {
			echo "Sikertelen adatfelvétel!<br />";
		}
	}
	public function kapcsolatbontas(){
		$this->conn->close();		
	}
}






?>