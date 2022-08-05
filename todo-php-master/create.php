
<!-- nu exista tabelul users -->

<?php

if (isset($_POST['submit'])) {
	require "../configs/config.php";

	try {
		$connection = new PDO($dsn, $username, $password, $options);
		// conecteaza la DB

		$new_user = array(
			"firstname" => $_POST['firstname'],
			"lastname"  => $_POST['lastname'],
			"email"     => $_POST['email'],
			"age"       => $_POST['age'],
			"location"  => $_POST['location']
		);

	$sql = sprintf(
		"INSERT INTO %s (%s) values (%s)",
		"users",
		implode(", ", array_keys($new_user)),
		":" . implode(", :", array_keys($new_user))
);
// == INSERT INTO users (firstname, lastname, ... ) values (:firstname, :lastname, ... )


	$statement = $connection->prepare($sql);
	$statement->execute($new_user);
	// introduce in users datele

	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
		// in caz de eroare de conectare la DB intoarce textul din $sql si eroarea
	}

}

include "templates/header.php"; ?><h2>Add a user</h2>



<form method="post">
	<label for="firstname">First Name</label>
	<input type="text" name="firstname" id="firstname">
	<!-- Introduce firstname -->
	<label for="lastname">Last Name</label>
	<input type="text" name="lastname" id="lastname">
	<!-- Introduce lastname -->
	<label for="email">Email Address</label>
	<input type="text" name="email" id="email">
	<!-- Introduce email -->
	<label for="age">Age</label>
	<input type="text" name="age" id="age">
	<!-- Introduce age -->
	<label for="location">Location</label>
	<input type="text" name="location" id="location">
	<!-- Introduce location -->
	<input type="submit" name="submit" value="Submit">
	<!-- buton submit -->
</form>

<a href="index.php">Back to home</a>
<!-- buton redirectionare la index.php -->

<?php include "templates/footer.php"; ?>
