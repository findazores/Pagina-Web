<?php 
// session_start inicia a sessão
session_start();

//Aceder a base de dados

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "findazores";


if(isset($_POST['user']) && isset($_POST['pass'])){
	$user=$_POST['user'];
	$pass=$_POST['pass'];
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "SELECT Nome, username, password FROM jogador where username=$user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$userBD=$row["username"];
        $passBD=$row["password"];
		$nome=$row["Nome"];
    }
} else {
	echo "ERRO";
    header('location:index.html');
}
$conn->close();

if($user==$userBD && $pass==$passBD){
	$_SESSION['user'] = $userBD;
	$_SESSION['pass'] = $passBD;
	$_SESSION['nome'] = $nome;
	header('location:principal.html');
}else{
	header('location:index.html');
}


?>