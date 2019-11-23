<?php 
	// Set variables for Database.
	$db_host = 'localhost';
	$db_user = 'db_username';
	$db_passwd = 'db_passwd';
	$db_database = 'db_database-name';


	session_start();
	$db = mysqli_connect($db_host, $db_user, $db_passwd, $db_database);

	// initialize variables
	$id = 0;
	$firma = "";
	$adresse = "";
	$tel = "";
	$email = "";
	$bemerkungen = "";
	$webseite = "";
	$beworben = false;
	$absage = false;

	if (isset($_POST['save'])) {
		$firma = $_POST['firma'];
		$adresse = $_POST['adresse'];
		$tel = $_POST['tel'];
		$email = $_POST['email'];
		$bemerkungen=$_POST['bemerkungen'];
		$webseite=$_POST['webseite'];
		$beworben=isset($_POST['beworben']);
		$absage=isset($_POST['absage']);

		mysqli_query($db, "INSERT INTO uebersicht (firma, adresse, tel, email, bemerkungen, webseite, beworben, absage) VALUES ('$firma', '$adresse', '$tel', '$email', '$bemerkungen', '$webseite', '$beworben', '$absage')"); 
		$_SESSION['message'] = "Addresse gespeichert"; // . "\INSERT INTO uebersicht (firma, adresse, tel, email, bemerkungen, webseite, beworben) VALUES ('$firma', '$adresse', '$tel', '$email', '$bemerkungen', '$webseite', '$beworben')"; 
		header('location: index.php');
	}


	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$firma = $_POST['firma'];
		$adresse = $_POST['adresse'];
		$tel = $_POST['tel'];
		$email = $_POST['email'];
		$bemerkungen=$_POST['bemerkungen'];
		$webseite=$_POST['webseite'];
		$beworben=isset($_POST['beworben']);
		$absage=isset($_POST['absage']);

		mysqli_query($db, "UPDATE uebersicht SET firma='$firma', adresse='$adresse', tel='$tel', email='$email', bemerkungen='$bemerkungen', webseite='$webseite', beworben='$beworben', absage='$absage' WHERE id=$id");
		$_SESSION['message'] = "Update ausgeführt!"; 
		header('location: index.php');
	}

if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM uebersicht WHERE id=$id");
	$_SESSION['message'] = "Eintrag gelöscht!"; 
	header('location: index.php');
}


	$results = mysqli_query($db, "SELECT * FROM uebersicht");


?>