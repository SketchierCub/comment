<?php
    require "../configs/config.php";
    require "./common.php";

    try {
        $connection = new PDO($dsn, $username, $password, $options);
        // conecteaza la DB

        $task =[
        "id"            => escape($_POST['id']),
        "summary"       => escape($_POST['summary']),
        "details"       => escape($_POST['details']),
        "priority"      => escape($_POST['priority']),
        "isComplete"    => escape($_POST['isComplete'])
        ];
      // transforma in htmlspecialchars intr-un array datele luate din edittask.php


        if ($_POST['dueDate']) {
            $task += ["dueDate" => escape($_POST['dueDate'])];
        } else {
            $task += ["dueDate" => NULL];
        }
        // daca exista dueDate, o adauga in array, daca nu o pune sub forma de NULL

        $sql = "UPDATE tasks
                SET
                summary = :summary,
                details = :details,
                priority = :priority,
                dueDate = :dueDate,
                isComplete  = :isComplete
                WHERE id = :id";
        // query pentru a schimba valorile in DB

        $statement = $connection->prepare($sql);
        $statement->execute($task); // executa cu valorile din $task

        header ("location: /index.php"); // trimite la index.php
    }


    catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    // in caz de eroare de conectare la DB intoarce textul din $sql si eroarea
    }
?>
