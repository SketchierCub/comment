
<?php require("./templates/header.php"); ?>
<?php require("./common.php"); ?>
<?php require("../configs/config.php"); ?>

    <div class="container">
        <?php require "./templates/nav.php" ?>
        <div class="card" style="width: 50%">
        <form method="post" style="padding: 20px" action="./performadd.php">
            <div class="form-group">
                <label for="summary" class="text-primary">Summary</label>
                <input class="form-control" id="summary" name="summary">
                <!-- adauga summary -->
                <label for="details" class="text-primary">Details</label>
                <textarea class="form-control" id="details" rows="3" name="details"></textarea>
                <!-- adauga details -->
                <label for="priority" class="text-primary">Priority</label>
                <select class="form-control" id="priority" name="priority">
                    <option>Low</option>
                    <option selected>Normal</option>
                    <option>High</option>
                </select>
                <!-- selecteaza priority ( default ii Normal ) -->
                <label for="dueDate" class="text-primary">Due Date:</label>
                <input type="date" class="form-control" id="dueDate" name="dueDate">
                <!-- adauga dueDate -->
                <input id="isComplete" name="isComplete" type="hidden" value="false">
                <!-- seteaza isComplete la false -->
            </div>
                <input  type="submit" class="btn btn-primary" name="submit" value="Add Task">
              <!--trimite la performadd.php prin _POST datele introduse-->
        </form>
        </div>
    </div> <!-- container -->

<?php require("./templates/footer.php"); ?>
