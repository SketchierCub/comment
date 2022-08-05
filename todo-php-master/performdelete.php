<?php
require "../configs/config.php";
require "./common.php";
?>
<?php
    if (isset($_POST['submit'])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);
            // conecteaza la DB

            $id = escape($_GET['id']);
            // seteaza $id ca htmlspecialchars din link

            $sql = "DELETE FROM tasks WHERE id = :id";
            // sterge randul din tabel pentru id-ul transmis

            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            // atribuie valoare la :id
            $statement->execute();

            header ("location: /index.php"); // redirectioneaza la index.php

        } catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
    // in caz de eroare de conectare la DB intoarce textul din $sql si eroarea
        }
      }
?>
