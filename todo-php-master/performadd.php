<?php
    require "../configs/config.php";
    require "./common.php";

        try {
        $connection = new PDO($dsn, $username, $password, $options); // conecteaza la DB

        $new_task = array(
            "summary"       => escape($_POST['summary']),
            "details"       => escape($_POST['details']),
            "priority"      => escape($_POST['priority']),
            "isComplete"    => escape($_POST['isComplete'])
        ); // transforma in htmlspecialchars intr-un array datele luate din addtask.php

        if ($_POST['dueDate']) {
            $new_task+= ["dueDate" => escape($_POST['dueDate'])];
        }
        // daca a fost introdusa data, se adauga la arrayul $new_task

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "tasks",
            implode(", ", array_keys($new_task)),
            ":" . implode(", :", array_keys($new_task))
        );
// == INSERT INTO tasks (summary, details, ... ) values (:summary, :details, ... )

        $statement = $connection->prepare($sql); // pregateste arrayul sal intruca in sql
        $statement->execute($new_task); // inlocuieste variabilele cu (:) cu cele din $new_task

        header ("location: /index.php"); // redirectioneaza la index.php
        }

        catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
            // in caz de eroare de conectare la DB intoarce textul din $sql si eroarea 
        }
?>
