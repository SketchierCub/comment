<!-- Begin showtask -->
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
          <!-- Afiseaza dueDate daca este, iar daca nu "Not spedified"-->
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
            <!-- Afiseaza priority in dependenta de caz ( Low, Normal, Low) -->
      </div>
    </div> <!-- Row #1 -->
    </div> <!-- Header -->
    <div class="card-body">
      <h5 class ="card-title"><?php echo $task["summary"]; ?></h5>
      <!-- Afiseaza summary -->
      <p class="card-text"><?php echo $task["details"]; ?></p>
      <!-- Afiseaza details -->

    </div> <!-- Body -->
    <div class="card-footer">
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
              <ul class="nav justify-content-end nav-pills card-header-pills"> <!-- creaza unordered list-->
                  <?php if ($task["isComplete"] == 'false') { ?>
                      <li class="nav-item">
                          <a class="nav-link" href="/edittask.php?id=<?php echo $task["id"] ?>"> <i class="fas fa-edit"></i></a>
                          <!-- Transmite prin link id-ul taskului -->
                      </li>
                  <?php } ?>
                  <!-- Daca taskul nu a fost completat, il editeaza in edittask.php -->

                  <li class="nav-item">
                      <a class="nav-link" href="/deletetask.php?id=<?php echo $task["id"] ?>"> <i class="fas fa-trash-alt"></i></a>
                      <!-- Transmite prin link id-ul taskului -->
                  </li>
                  <!-- Sterge taskul din DB -->

                  <li class="nav-item">
                      <form method="post" action="/completetask.php?id=<?php echo $task["id"] ?>">
                          <button type="submit" class="btn btn-link">
                              <?php if ($task["isComplete"] == 'false') { ?>
                                  <i class="fas fa-check"></i>
                                  <!-- afiseaza bifa ... -->
                              <?php } else { ?>
                                  <i class="fas fa-redo-alt"></i>
                                  <!-- afiseaza iconita redo ... -->
                              <?php } ?>
                          </button>
                      </form>
                      <!-- trimite la completetask.php cu id-ul prin link -->
                  </li>
              </ul>
          </div>
      </div>
  </div>
</div> <!-- Card -->
           <p>
<!-- End showtask -->
