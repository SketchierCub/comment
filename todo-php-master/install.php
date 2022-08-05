

<?php require("./templates/header.php"); ?>

	<h2>Creating Database</h2> <br>

	<?php
	require "../configs/config.php";

	try {
		echo "<br> Connecting to database. <p>";
		$connection = new PDO("mysql:host=$host", $username, $password, $options);
		// se conecteaza la mysql

		$sql = file_get_contents("data/init.sql"); // copie in forma de string din init.sql in $sql

		$connection->exec($sql);

		echo "Database and table created successfully.";
	} catch(PDOException $error) {
		echo "ERROR!! - " . $sql . "<br>" . $error->getMessage();
		// in caz de eroare afiseaza $sql si eroarea 
	}
	?>

<?php require("./templates/footer.php"); ?>
