<?php

    if (isset($_POST['submit']) && $statement) {
     header('Location: /index.php');
    }

    require "../configs/config.php";
    require "./common.php";

    if (isset($_GET['id'])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);
            // conecteaza la DB

            $id = $_GET['id'];  // primeste $id din link

            $sql = "SELECT * FROM tasks WHERE id = :id";
            $statement = $connection->prepare($sql);
            // pregateste statementul si il trimite la DB
            $statement->bindValue(':id', $id);
            // atribuie in $statement la :id valoarea din link
            $statement->execute();

            $task = $statement->fetch(PDO::FETCH_ASSOC);
            // salveaza in task task-ul cu id-ul transmis

        }   catch(PDOException $error) {
                echo $sql . "<br>" . $error->getMessage();
        // in caz de eroare de conectare la DB intoarce textul din $sql si eroarea
        }
    }
?>


<?php require("./templates/header.php"); ?>

    <div class="container">
        <?php require("./templates/nav.php"); ?>
        <div class="card" style="width: 50%">
        <form method="post" action="performedit.php" style="padding: 20px">
            <div class="form-group">
                <label for="summary" class="text-primary">Summary</label>
                <input class="form-control" id="summary" name="summary" value="<?php echo $task["summary"]; ?>">

                <label for="details" class="text-primary">Details</label>
                <textarea rows="3" class="form-control" id="details" name="details"><?php echo $task["details"]; ?></textarea>

                <label for="priority" class="text-primary">Priority</label>
                <select class="form-control" id="priority" name="priority">
                <?php
                    switch($task["priority"]) {
                        case 'Normal': ?>
                            <option>Low</option>
                            <option selected>Normal</option>
                            <option>High</option> <?php
                        break;
                        case 'High': ?>
                            <option>Low</option>
                            <option>Normal</option>
                            <option selected>High</option> <?php
                        break;
                        case 'Low': ?>
                            <option selected>Low</option>
                            <option>Normal</option>
                            <option>High</option> <?php
                        break;
                    } ?>
                    <!-- afiseaza case-ul in baza la priority selectat -->
                </select>
                <input id="isComplete" name="isComplete" type="hidden" value="<?php echo $task["isComplete"]; ?>">
                <input id="id" name="id" type="hidden" value="<?php echo $task["id"]; ?>">
                <label for="duedate" class="text-primary">Due Date:</label>
                <input type="date" class="form-control"  id="duedate" name="dueDate" value="<?php echo date('Y-m-j',strtotime($task["dueDate"])); ?>">
            </div>
                <input type="submit" name="submit" class="btn btn-primary" value="Save Task">
                <!--trimite la performedit.php prin _POST datele introduse-->
                <!-- Face aproape tot aceeasi ca si in addtask.php doar ca le atribuie valoare deodata-->
        </form>
        </div>
    </div> <!-- container -->

<?php require("./templates/footer.php"); ?>
