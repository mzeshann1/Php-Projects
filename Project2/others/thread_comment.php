<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8314cd6427.js" crossorigin="anonymous"></script>
</head>

<body>


    <!-- including some imp files  -->
    <?php
    session_start();
        // database connection
        require "../partials/_dbconnect.php";
        // navbar
        require "../partials/_header.php";
        // login form
        require "../partials/_login.php";
        // signup form
        require "../partials/_signup.php";
    ?>

    <!-- inserting comments thorugh the form to the database question table -->
    <?php

        if($_SERVER["REQUEST_METHOD"]== "POST")
            {
                // getting the values from the form and storing them in some variable
            $ins_c_description=$_POST["inp_c_description"];
            // saving from xss attack
            $ins_c_description=str_replace("<","&lt",$ins_c_description);
            $ins_c_description=str_replace(">","&gt",$ins_c_description);
            
            $qid=$_GET["question_id"];
            $by_user=$_SESSION['user_sno'];


            // ruunning sql insertion quert
            $sql="INSERT INTO `comments` (`comment_id`, `comment_description`, `question_id`, `comment_by`) VALUES (NULL, '$ins_c_description', '$qid', '$by_user');";

            $result=mysqli_query($conn , $sql);

            // checking the insertion and showing the result through the alert
            if($result)
            {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> You have added your comment in the discussion.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';

            }


        }

    ?>










    <!-- displaying the questions -->

    <div class="container mt-3">
        <h2 class="text-center mt-5 mb-5">Question to be Discussed</h2>
<?php
        // fetching values of categories from the database 

        $qid=$_GET["question_id"];
        $sql="SELECT * FROM `questions` WHERE `questions`.`question_id` = $qid";
        $result=mysqli_query($conn , $sql);
        $no_question=true;

        // using loop to get all the values/data and to show that particular selected card 
        while($row=mysqli_fetch_assoc($result))
        {
            // storing database values in some variable 
            $q_id=$row["question_id"];
            $q_title = $row["question_title"];
            $q_description = $row["question_description"];
            $q_time=$row["created"];
            $no_question=false;


            $q_user_id=$row["user_id"];
            $sql2="SELECT user_first_name FROM users WHERE sno= $q_user_id ";
            $result2=mysqli_query($conn , $sql2);
            $row2=mysqli_fetch_assoc($result2);
            // '.$row2["user_first_name"].'

        echo '
        <div class="media ">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item mt-2" >
                    <h2 class="accordion-header "  >
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$q_id.'" aria-expanded="true" aria-controls="collapse'.$q_id.'" style="background-color: #6351ce !important;">
                        <span style="font-size: 30px;"><i class="fa-solid fa-circle-user fa-xl me-2"></i>  '.$q_title.' </span>
                        &nbsp;
                        &nbsp;
                        <span>by</span>
                        &nbsp;

                        <span>  '.$row2["user_first_name"].' at '.$q_time.' </span>

                    </button>
                    </h2>
                    <div id="collapse'.$q_id.'" class="accordion-collapse collapse show" data-bs-parent="#accordionExample" >
                    <div class="accordion-body">
                            <p class=" ps-1" ><a href="" style="color: black !important; text-decoration: none; font-size: 25px;" >'.$q_description.'</a></p>
                            <br>
                            <a href="#c1" class="btn btn-primary">Add Comment</a>
                    </div>
                    </div>
                </div>
            </div>
        ';
        



        }
?>

    </div>

        <!-- to show the comments from the database -->
        <section>
            <div class="container mt-2">
                <h2 class="text-center mt-5 mb-5">Comments</h2>
                <div class="media">
                    <!-- form to insert the comment in the database -->

                    <?php
                        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true)
                        {
                            echo '
                            <div class="container card p-5 ">
                            <h3 class="text-center mb-3">ADD New Comment</h3>
                            <form action="../others/thread_comment.php?question_id='.$qid.'" method="post">
                                <div class="mb-3">
                                    <label for="inp_c_description" class="form-label" id="c1">Comment Description</label>
                                    <textarea name="inp_c_description" class="form-control" id="inp_q_description" cols="10"
                                        rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                            ';
                            
                        }
                        else
                        {
                            echo '
                            <div class="container card p-5 ">
                            <h3 class="text-center mb-3">ADD New Comment</h3>
                            <form action="../others/thread_comment.php?question_id='.$qid.'?>" method="post">
                                <div class="mb-3">
                                    <label for="inp_c_description" class="form-label" id="c1">Comment Description</label>
                                    <textarea name="inp_c_description" class="form-control" id="inp_q_description" cols="10"
                                        rows="3" disabled></textarea>
                                </div>
                                <button type="reset" class="btn btn-primary">please login first to start the discussion</button>
                            </form>
                        </div>
                            ';
                        }
                    ?>







                    <?php
                                    $qid=$_GET["question_id"];
                                    $sql="SELECT * FROM `comments` WHERE `question_id` = $qid";
                                    $result=mysqli_query($conn , $sql);
                                    $no_comment=true;
                            
                                    // using loop to get all the values/data and to show that particular selected card 
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        // storing database values in some variable 
                                        $c_id=$row["comment_id"];
                                        $c_description = $row["comment_description"];
                                        $c_time = $row["comment_at"];
                                        $no_comment=false;
                                        $c_user_id=$row["comment_by"];
                                        
                                        
                                        
                                        $sql2="SELECT user_first_name FROM users WHERE sno= $c_user_id ";
                                        $result2=mysqli_query($conn , $sql2);
                                        $row2=mysqli_fetch_assoc($result2);
                                        // '.$row2["user_first_name"].'
                                        


                                    echo '
                                    <div class="media ">
                                        <div class="accordion" id="accordionExample">
                                            <div class="accordion-item mt-2" >
                                                <h2 class="accordion-header "  >
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$c_id.'" aria-expanded="true" aria-controls="collapse'.$c_id.'" style="background-color: #6351ce !important;">

                                                <span><i class="fa-solid fa-circle-user fa-xl me-2"></i>  '.$row2["user_first_name"].' at '.$c_time.' </span>

                            
                            
                                                </button>
                                                </h2>
                                                <div id="collapse'.$c_id.'" class="accordion-collapse collapse show" data-bs-parent="#accordionExample" >
                                                <div class="accordion-body">
                                                        <p class=" ps-1" ><a href="" style="color: black !important; text-decoration: none; " >'.$c_description.'</a></p>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    ';






















                                    }

                                    // if there is no comment then show this message
                                    if($no_comment==true)
                                    {
                                        echo '
                                        <div class="card mt-5">
                                            <div class="card-body">
                                                <!-- This is some text within a card body. -->
                                                <div class="alert alert-secondary"  role="alert">
                                                    <h6 class="text-center">There are no comments to this Question</h6>
                                                    <p class="text-center">Be the First one to start the discussion <a href="" style="color: black !important;">click here</a></p>
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                    }
                            ?>






                </div>

            </div>

        </section>





        
            <?php
            require "../partials/_footer.php";
            ?>





        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
        </script>

</body>

</html>