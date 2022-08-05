<?php
    require "../configs/config.php";
    require "./common.php";


    if (isset($_GET['id'])) { // daca exista id in arrayul GET ( din link ) se executa corpul
        try {
            $connection = new PDO($dsn, $username, $password, $options);
            // conecteaza la DB

            $id = $_GET['id'];
            // seteaza $id din id-ul din link

            $sql = "SELECT * FROM tasks WHERE id = :id";
            // selecteaza taskul din DB cu id-ul transmis

            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();

            $task = $statement->fetch(PDO::FETCH_ASSOC);
            // salveaza in task ca associative array

        }   catch(PDOException $error) {
                echo $sql . "<br>" . $error->getMessage();
            // in caz de eroare de conectare la DB intoarce textul din $sql si eroarea
        }
    }
?>


<?php require("./templates/header.php"); ?>

    <div class="container">
        <?php require("./templates/nav.php"); ?>
        <?php
        if ($statement->rowCount() != 0) { ?>  <!-- Daca exista elemente in array se executa corpul -->
            <div class="card border-primary" style="width: 50%">
              <div class="card-header">
              <div class="row">
                  <div class="col-sm">
                    Due By:
                    <?php if ($task["dueDate"] != '') {
                        echo date('n/j/Y',strtotime($task["dueDate"]));
                      } else  {
                          echo "Not specified";
                      } ?>
                      <!-- afiseaza dueDate daca a fost transmisa, iar daca nu afiseaza un mesaj -->
                  </div>
                  <div class="col-sm">
                      <?php
                       switch($task["priority"]) {
                          case 'Normal': ?>
                            <span class="badge float-right badge-warning">Priority: Normal</span> <?php
                            break;
                          case 'High': ?>
                            <span class="badge float-right badge-danger">Priority: High</span> <?php
                            break;
                          case 'Low': ?>
                            <span class="badge float-right badge-success">Priority: Low</span> <?php
                          break;
                        } ?>
                        <!-- Afiseaza tipul de priority -->
                  </div>
                </div> <!-- Row #1 -->
                </div> <!-- Header -->
                <div class="card-body">
                  <h5 class ="card-title"><?php echo $task["summary"]; ?></h5>
                  <!-- Afiseaza summary -->
                  <p class="card-text"><?php echo $task["details"]; ?></p>
                  <!-- Afiseaza details -->

                </div> <!-- Body -->
                <div class="card card-footer">
                  <div class = "row">
                      <div class = "col-sm">
                          <?php if ($task["isComplete"] == 'false') { ?>
                              <h4><span class="badge badge-secondary">Incomplete</span></h4>
                          <?php } else { ?>
                              <h4><span class="badge badge-secondary">Complete</span></h4>
                          <?php } ?>
                          <!-- Afiseaza daca taskul a fost completat sau nu -->
                      </div>
                      <div class = "col-sm">
                          <ul class="nav justify-content-end nav-pills card-header-pills">
                              <?php if ($task["isComplete"] == 'false') { ?>
                                  <li class="nav-item">
                                      <a class="nav-link"> <i class="fas fa-edit"></i></a>
                                  </li>
                              <?php } ?>
                              <li class="nav-item">
                                  <a class="nav-link"> <i class="fas fa-trash-alt"></i></a>
                              </li>
                              <li class="nav-item">
                                    <?php if ($task["isComplete"] == 'false') { ?>
                                        <a class="nav-link"> <i class="fas fa-check"></i></a>
                                    <?php } else { ?>
                                        <a class="nav-link"> <i class="fas fa-redo-alt"></i></a>
                                    <?php } ?>
                              </li>
                          </ul>
                          <!-- aici nui clar ce face -->
                      </div>
                  </div>
              </div>
            </div> <!-- Card -->
           <p>
           <div class ="row" style="width: 53%">
                    <div class="col-sm">
                        <form method="post" action="/performdelete.php?id=<?php echo $id ?>">
                          <!-- transmite prin link id-ul pentru a fi sters -->
                            <input type="submit" name="submit" class="btn btn-danger" value="Delete Task">
                            <!-- buton pentru delete task -->
                        </form>
                    </div>
                    <div class="col-sm">
                         <a class="btn btn-primary float-right"  href="/" role="button">Cancel</a>
                         <!-- pentru a anula si a iesi din deletetask.php -->
                    </div>

                  </div>


        <?php } else { // Daca nu exista taskuri se afiseazaa mesajul
            echo "<h4>Error: No records returned</h4>";
        } ?>
    </div> <!-- container -->

<?php require("./templates/footer.php"); ?>
