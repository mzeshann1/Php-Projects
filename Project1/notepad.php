<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!= true)
{
  header("location:login.php");
  exit;
}

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NOTEPAD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="../Project1/design/_design.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>
<body>




  <?php
    require "partials/_navbar.php";
    require "partials/_dbconnect.php";
    ?>
  <?php

    // variable for errors handling to show some of the alerts 
    $insert=false;
    $update=false;
    $delete=false;
    $filltitle=false;
    $filldescription=false;


    if ($_SERVER["REQUEST_METHOD"]=="POST") {
      if(isset($_POST["edit_sno"]))
      {
        $up_sub=$_POST["edit_subject"];
        $up_description=$_POST["edit_description"];
        $up_sno=$_POST["edit_sno"];
        if(!empty($up_sub))
        {
          if(!empty($up_description))
          {
            // update the note
            $sql ="UPDATE `notes` SET `subject` = '$up_sub', `description` = '$up_description' WHERE `notes`.`no` = $up_sno;";
             $result=mysqli_query($conn , $sql);
             if($result)
             {
             $update=true;
             }
          }
          else{
            $filldescription=true;
          }
        }
        else{
          $filltitle=true;
        }
      }
    // doing insertion in the database 

      else
      {
        $sub=$_POST["inp_subject"];
        $desc=$_POST["inp_description"];
        if (!empty($sub))
        {
        if(!empty($desc))
        {
        $sql =
        "INSERT INTO `notes` ( `no`,`subject`, `description`, `Time`) VALUES ('','$sub', '$desc', current_timestamp())";
        $result=mysqli_query($conn , $sql);
        if($result)
        {
        $insert=true;
        }
        }
        else{
        $filldescription=true;
        }
        }
        else{
        $filltitle = true;
        }
      }

      }
      // deleting the record
      if(isset($_GET['delete'])){
        $sno=$_GET['delete'];
        $sql = "DELETE FROM `notes` WHERE `notes`.`no` = $sno";
        mysqli_query($conn ,$sql);
        $delete=TRUE;
      }
    ?>

  <?php
    if($insert)
    {
    echo '<div class="alert alert-success alert-dismissible fade show"
      role="alert">
      <strong>Congratulations! </strong> Your note has been successfuly added .
      <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
    </div>';
    }
    if($update)
    {
    echo '<div class="alert alert-success alert-dismissible fade show"
      role="alert">
      <strong>Congratulations! </strong> Your note has been successfuly updated .
      <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
    </div>';

    }
    if($delete)
    {
    echo '<div class="alert alert-success alert-dismissible fade show"
      role="alert">
      <strong>Congratulations! </strong> Your note has been successfuly updated .
      <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
    </div>';

    }
    if($filltitle)
    {
    echo '
      <div class="alert alert-warning alert-dismissible fade show"
        role="alert">
        <strong>Failed ! </strong> Your note must have a title .
        <button type="button" class="btn-close" data-bs-dismiss="alert"
          aria-label="Close"></button>
      </div>
    ';
    }
    if($filldescription)
    {
    echo '
      <div class="alert alert-warning alert-dismissible fade show"
        role="alert">
        <strong>Failed ! </strong> Your note must have a description .
        <button type="button" class="btn-close" data-bs-dismiss="alert"
          aria-label="Close"></button>
      </div>
    ';
    }

    ?>

  <!-- inputting the data through the form -->
  <section>
    <div class="container inp_note_form ">
      <h1>NOTEPAD</h1>
      <form method="post" action="../Project1/notepad.php">
        <div class="mb-3">
          <label for="inp_subject" class="form-label">Subject</label>
          <input type="text" class="form-control" id="inp_subject" name="inp_subject" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="inp_description" class="form-label">Description</label>
          <textarea name="inp_description" id="inp_description" cols="15" rows="4" class="form-control"></textarea>
        </div>
        <div style="display: flex; justify-content: center; align-items: center;">
          <button type="submit" class="btn btn-primary me-1">Submit</button>
          <button type="reset" class="btn btn-primary">Clear</button>
        </div>
      </form>
    </div>
  </section>
  <!-- editing in a modal and updating the record -->

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="../Project1/notepad.php">
            <div class="mb-3">
              <input type="hidden" name="edit_sno" id="edit_sno">
              <label for="edit_subject" class="form-label">Subject</label>
              <input type="text" class="form-control" id="edit_subject" name="edit_subject"
                aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="edit_description" class="form-label">Description</label>
              <textarea name="edit_description" id="edit_description" cols="15" rows="4"
                class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary me-1">Submit</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        <!-- <div class="modal-footer">
          <div style="display: flex; justify-content: center; align-items: center;">
            <button type="submit" class="btn btn-primary me-1">Submit</button>
          </div>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> -->
        </form>
      </div>
    </div>
  </div>

  <!-- displaying the data from the database -->
  <section>
    <div class="container mt-5">
      <table class="table" id="myTable">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sql= "SELECT * FROM `notes`";
            $result=mysqli_query($conn , $sql);
            $num = mysqli_num_rows($result);

            $no=1;
            if($num>0)
            {
            for($i=0;$i<$num;$i++)
            {
            $row = mysqli_fetch_assoc($result);
            echo " <tr>
              <th scope='row'>".$no."</th>
              <td>".$row["subject"]."</td>
              <td>".$row["description"]."</td>
              <td><button class='btn btn-primary edit' id='".$row["no"]."'>Edit</button>
                <button class='btn btn-primary delete' id='d".$row["no"]."'>Delete</button></td>
            </tr>";
            $no=$no+1;
            }
            }
            ?>
        </tbody>
      </table>
    </div>
  </section>


  <script>
    editing = document.getElementsByClassName('edit');
    Array.from(editing).forEach(element => {
      element.addEventListener("click", (e) => {
        // here we are getting the eventlistener on the every class of edit
        console.log("okay");
        // targeting the parent row of the class edit 
        tr = e.target.parentNode.parentNode;
        console.log(tr);
        // targeting the td of the tr 
        getting_title = tr.getElementsByTagName("td")[0].innerText;
        getting_description = tr.getElementsByTagName("td")[1].innerText;
        console.log(e.target.id);
        console.log(getting_title, getting_description);
        edit_subject.value = getting_title;
        edit_description.value = getting_description;
        edit_sno.value = e.target.id;
        console.log(edit_sno);
        $('#editModal').modal('toggle');
        // if i want to move this to anothe location 
        // window.location.href="../Project1/update.php"
      })
    });


    deleting=document.getElementsByClassName('delete');
  Array.from(deleting).forEach((element) => {
    element.addEventListener("click", (e)=>{
      console.log("we are getting the eventlistener on delete button",);
      delete_sno=e.target.id.substr(1,);
      if (confirm("You want to delete this record ?")) {
        console.log("yes delete the record");
        window.location = `/zeeshan_projects/project1/notepad.php?delete=${delete_sno}`;
      }
      else{
        console.log("do not delete the record");
      }
    }) 
  });
  </script>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
    integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
</body>

</html>