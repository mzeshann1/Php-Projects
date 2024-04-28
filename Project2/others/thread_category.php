<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8314cd6427.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../partials/index.css">
</head>

<body>


<!-- including some imp files  -->
    <?php
        // starting the session
        session_start();
        // connecting the database 
        require "../partials/_dbconnect.php";
        // taking header from the _header.php
        require "../partials/_header.php";
        // taking login and signup functionalities on this page as well
        require "../partials/_login.php";
        require "../partials/_signup.php";
    ?>



<!-- inserting questions thorugh the form to the database question table -->
    <?php

        if($_SERVER["REQUEST_METHOD"]== "POST")
            {
                // getting the values from the form and storing them in some variable
            $ins_q_title=$_POST["inp_q_title"];
            // saving from xss attack
            $ins_q_title=str_replace("<","&lt",$ins_q_title);
            $ins_q_title=str_replace(">","&gt",$ins_q_title);



            $ins_q_description=$_POST["inp_q_description"];
            // saving from xss attack
            $ins_q_description=str_replace("<","&lt",$ins_q_description);
            $ins_q_description=str_replace(">","&gt",$ins_q_description);
            

            $cid=$_GET["catid"];
            $by_user=$_SESSION['user_sno'];


            // ruunning sql insertion query
            $sql="INSERT INTO `questions` (`question_id`, `question_title`, `question_description`, `category_id`, `user_id`, `created`) VALUES (NULL, '$ins_q_title', '$ins_q_description', '.$cid.', '.$by_user.', current_timestamp())
            ";
            $result=mysqli_query($conn , $sql);

            // checking the insertion and showing the result through the alert
            if($result)
            {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> You have added your question in the discussion.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';

            }


        }

    ?>



















    <!-- cards to show  the single thread catgehory topic-->
    <section>
        <div class="container-fluid text-center mt-5">
            <?php
            $cname=$_GET["catname"];
            echo '<h2>Welcome to the  <u><strong>'.$cname.'</strong></u> Forum </h2>';
            ?>
            <div class="row mt-1 ms-4 me-4">
                <?php
        // fetching values of that particular category from the database 

        $cid=$_GET["catid"];
        $sql="SELECT * FROM `categories` WHERE `categories`.`category_id` = $cid";
        $result=mysqli_query($conn , $sql);

        // using loop to get all the values/data and to show that particular selected card 
        while($row=mysqli_fetch_assoc($result))
        {

          // storing database values in some variable 
          $cat_name = $row["category_name"];
          $cat_description = $row["category_description"];


        //   displayin that particular category values of title and description
          echo '        
              <div class="col-12 mt-5" style="display: flex; justify-content: center; align-items: center;" >
                  <div class="card p-5" style="width: 88%; display: flex; justify-content: center; align-items: center;">
                        <img src="https://source.unsplash.com/1200x400/?html" style="border: 1px solid black; border-radius: 10px; width: 70%;" class="card-img-top" alt="...">
                        
                      <div class="card-body">
                        <h5 class="card-title mt-4"><b><u><h2>'.$cat_name.'</h2></u></b></h5>
                        <p class="card-text mt-3">'.$cat_description.'</p>
                        <div class="container p-5" style="width: 80%;">
                            <hr class="mt-5 ">
                            <div class="container">
                                <small style="text-align: center;"><strong>-- Rules --</strong></small>
                                <p class="p-2"><small>Keep it friendly
                                    Be courteous and respectful. Appreciate that others may have an opinion different from yours.
                                    Stay on topic. When creating a new discussion thread, give a clear topic title and put your post in the appropriate category. When contributing to an existing discussion, try to stay on topic.</small> </p>
                                </div>
                            </div>
                      </div>
                    </div>
              </div>
         ';

        }
        ?>
            </div>
        </div>
    </section>







    <!-- card to show the quetions of that sinlge thread -->
    <section>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true)
    {
        echo '
        <div class="container-fluid mt-5 " style="width: 100%;">
        <!-- form for inserting the questions -->
        <div class="container card p-5 ">
            <h3 class="text-center mb-5">Ask Anything</h3>
            <form action="../others/thread_category.php?catid='.$cid.'&catname='.$cname.'" method="post">
                <div class="mb-3">
                    <label for="inp_q_title" class="form-label">Question Title</label>
                    <input type="text" name="inp_q_title" class="form-control" id="inp_q_title">
                </div>
                <div class="mb-3">
                    <label for="inp_q_description" class="form-label">Question Description</label>
                    <textarea name="inp_q_description" class="form-control" id="inp_q_description" cols="10"
                        rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        ';

    }
    else{
          echo '
          <div class="container-fluid mt-5 " style="width: 100%;">
          <!-- form for inserting the questions -->
          <div class="container card p-5 ">
              <h3 class="text-center mb-5">Ask Anything</h3>
              <form aria-disabled="true" action="../others/thread_category.php?catid='.$cid.'&catname='.$cname.'" method="post" >
                  <div class="mb-3">
                      <label for="inp_q_title" class="form-label">Question Title</label>
                      <input type="text" name="inp_q_title" class="form-control" id="inp_q_title" disabled>
                  </div>
                  <div class="mb-3">
                      <label for="inp_q_description" class="form-label">Question Description</label>
                      <textarea name="inp_q_description" class="form-control" id="inp_q_description" cols="10"
                          rows="3" disabled></textarea>
                  </div>
                  <button type="reset"  class="btn btn-primary"><small>please login first to start the discussion</small></button >
              </form>
          </div>';
          

    }

    ?>





            <div class="cotainer text-center p-5">
                <h1><u>BROWSE QUESTION'S</u></h1>
            </div>

            <div class="container mt-5">
                <div class="row">
                  <div class="col-md-8 offset-md-2">
                    <!-- User Icon and Name -->
                    <div class="d-flex align-items-center mb-3">
                      <img src="user-icon.jpg" alt="User Icon" class="rounded-circle mr-3" style="width: 50px; height: 50px;">
                      <h5>User Name</h5>
                    </div>
              
                    <!-- Comment Area -->
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">User's Comment</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <!-- Reply Button -->
                        <button class="btn btn-primary reply-btn">Reply</button>
                      </div>
              
                      <!-- Reply Section -->
                      <div class="card-footer reply-section d-none">
                        <!-- Form to add a reply -->
                        <form class="reply-form">
                          <div class="form-group">
                            <textarea class="form-control" placeholder="Write a reply" rows="2"></textarea>
                          </div>
                          <button type="submit" class="btn btn-primary">Add Reply</button>
                        </form>
              
                        <!-- Replies -->
                        <div class="replies mt-3">
                          <!-- Sample reply -->
                          <div class="border p-2 mb-2">
                            <strong>User1:</strong> Reply 1
                          </div>
                          <div class="border p-2 mb-2">
                            <strong>User2:</strong> Reply 2
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            



            <!-- displaying the questions -->
<div class="container mt-3" >
    <div class="media">
        <?php
        // fetching values of categories from the database 
        $cid = $_GET["catid"];
        $sql = "SELECT * FROM `questions` WHERE `questions`.`category_id` = $cid";
        $result = mysqli_query($conn, $sql);
        $no_question = true;
        $count = 0;

        // using loop to get all the values/data and to show that particular selected card 
        while ($row = mysqli_fetch_assoc($result)) {
            // storing database values in some variable 
            $q_id = $row["question_id"];
            $q_title = $row["question_title"];
            $q_description = $row["question_description"];
            $no_question = false;
            $q_time = $row["created"];
            $q_user_id = $row["user_id"];

            $sql2 = "SELECT user_first_name FROM users WHERE sno= $q_user_id ";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            // '.$row2["user_first_name"].'
            echo '
            <div class="accordion" id="accordionExample">
                <div class="accordion-item mt-2">
                    <h2 class="accordion-header">
                        <div class="row">
                            <div class="col-md-10">
                                <button class="accordion-button" type="none" data-bs-toggle="collapse" data-bs-target="#collapse' . $q_id . '" aria-expanded="true" aria-controls="collapse' . $q_id . '" style="background-color: #6351ce !important;">
                                    <div>
                                        <div>
                                            <span><i class="fa-solid fa-circle-user fa-xl me-2"></i>  ' . $q_title . ' </span>
                                                &nbsp;
                                                <span>by</span>
                                                &nbsp;
                                            <span>  ' . $row2["user_first_name"] . ' at ' . $q_time . ' </span>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div class="col-md-2" >
                                <a style="background-color: #6351ce !important;" href="../others/thread_comment.php?question_id=' . $q_id . '" class="btn btn-primary ">Comment</a>
                            </div>
                        </div>

                    </h2>
                    <div id="collapse' . $q_id . '" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class=" ps-1"><a href="" style="color: black !important; text-decoration: none;">' . $q_description . '</a></p>
                            <a href="../others/thread_comment.php?question_id=' . $q_id . '" class="btn btn-primary">Comment on this question</a>
                        </div>
                    </div>
                </div>
            </div>


            ';
            

            $count++;
            // Break loop after 5 items
            if ($count >= 2) {
                break;
            }

        }
        echo '             <div id="questionContainer">
        <!-- Existing questions will be displayed here -->
    </div>';

        // if there is no question, show this message
        if ($no_question == true) {
            echo '
            <div class="card mt-5">
                <div class="card-body">
                    <div class="alert alert-secondary" role="alert">
                        <h6 class="text-center">There are no Questions in this Thread</h6>
                        <p class="text-center">Be the First one to start the discussion <a href="" style="color: black !important;">click here</a></p>
                    </div>
                </div>
            </div>
            ';
        }

        // Show "Show More" button if there are more than 5 questions
        if ($count >= 2) {
            echo '<button class="btn btn-primary mt-3" id="showMoreBtn">Show More</button>';
        }
        ?>
    </div>
</div>







        </div>
    </section>

























    <?php
    require "../partials/_footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function () {
    var count = 2;
    $('#showMoreBtn').on('click', function () {
        count += 2;
        var buttonContainer = $(this).parent(); // Get the container of the button
        $.ajax({
            type: 'POST',
            url: 'load_more_questions.php',
            data: {
                count: count,
                cid: <?php echo $cid; ?>
            },
            success: function (data) {
                // Append new questions below existing questions
                $('#questionContainer').append(data);

                // Check if there are more questions to show
                if (data.trim().length == 0) {
                    $('#showMoreBtn').hide(); // Hide the button if no more questions available
                }
            }
        });
    });
});

</script>


<script>
  $(document).ready(function(){
    // Toggle reply section visibility
    $('.reply-btn').click(function(){
      $(this).closest('.card').find('.reply-section').toggleClass('d-none');
    });

    // Handle adding replies
    $('.reply-form').submit(function(event){
      event.preventDefault();
      var replyText = $(this).find('textarea').val();
      if(replyText.trim() !== ''){
        var reply = '<div class="border p-2 mb-2"><strong>User:</strong> ' + replyText + '</div>';
        $(this).closest('.reply-section').find('.replies').append(reply);
        $(this).find('textarea').val('');
      }
    });
  });
</script>






</body>

</html>