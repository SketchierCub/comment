<?php
	try {
		require "../configs/config.php";
		require "./common.php";

		$connection = new PDO($dsn, $username, $password, $options);
		// conecteaza la DB

		$sql = "SELECT * FROM tasks";
		// selecteaza toate datele din DB

		$statement = $connection->prepare($sql);
		$statement->execute();
    $result = $statement->fetchAll();
		// salveaza in $result toate datele din DB

	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
		// in caz de eroare de conectare la DB intoarce textul din $sql si eroarea
	}
?>


<?php require("./templates/header.php"); ?>

    <div class="container">
      <?php
         require("./templates/nav.php");
         if (!$result && $statement->rowCount() == 0) { ?>
          <h4> No tasks to display. Add one above.</h4>
					<!-- Daca nu exista nici un task se afiseaza mesajul -->
         <?php }
         else
         {
            foreach ($result as $task) {
              require("./templates/showtask.php");
						// Daca exista taskuri, atunci pentru fiecare task aparte se afiseaza in showtask.php
          } ?> <!-- else -->
				} // <!-- foreach --> 

    </div> <!-- container -->

    <?php require("./templates/footer.php"); ?>
