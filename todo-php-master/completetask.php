<?php
    require "../configs/config.php";

    try {
        $connection = new PDO($dsn, $username, $password, $options);
        // conecteaza la DB


        $id = $_GET['id'];
        // seteaza id din link

        $sql = "SELECT isComplete FROM tasks WHERE id = :id";
        // selecteaza isComplete pentru id din link
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $state = $statement->fetch(PDO::FETCH_ASSOC);
        // salveaza in $state associative array din DB


        if ($state['isComplete'] == 'false') {
            $isComplete = 'true';
        } else {
            $isComplete = 'false';
        }
        // daca isComplete este false, il seteaza true, si invers

        $sql = "UPDATE tasks
                SET
                    isComplete  = :isComplete
                WHERE id = :id";
        // seteaza isComplete in DB

        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':isComplete', $isComplete);
        // atribuie valori la :id si :isComplete
        $statement->execute();

        header ("location: /index.php"); // redirectioneaza la index.php


    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    // in caz de eroare de conectare la DB intoarce textul din $sql si eroarea
    }
?>
