<!-- google recaptcha -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- title of the webpage -->
    <title>iDiscuss</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- fontawesome icons kit -->
    <script src="https://kit.fontawesome.com/8314cd6427.js" crossorigin="anonymous"></script>
    <!-- including custom css file  -->
    <link rel="stylesheet" href="../Project2/partials/index.css">
    <!-- google recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>



</head>

<body>

    <?php

session_start();


// connection to the database
require "partials/_dbconnect.php";

// including the navbar
require "partials/_header.php";

// including the login functionality page with login form
require "partials/_login.php";

// including the signup functionality page with signup form
require "partials/_signup.php";

    ?>
    <?php

    // when user already exist in signup form
    if( isset( $_GET["userexist"]) && $_GET["userexist"] =="true" )
        {
            echo '<div class="container_fluid" style="  position: absolute; z-index: 100; width:100%;  ">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>sorry!</strong> user already exist.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div> ';
        }

    // when passowrd does not match in signup form 
    if( isset( $_GET["passwordmatch"]) && $_GET["passwordmatch"] =="false" )
    {
        echo '<div class="container_fluid" style="  position: absolute; z-index: 100; width:100%;  ">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>sorry!</strong> password does not matched.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div> ';
    }

    // when insertion is succesful of signup form
    if( isset( $_GET["signedup"] ) && $_GET["signedup"] =="true"  )
        {
            $user=$_GET["username"];
            echo '<div class="container_fluid" style="  position: absolute; z-index: 100; width:100%;  ">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>'.$user.' !</strong> You are signedup.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div> ';
        }
    // when isertion does not happen in signup form
    if( isset( $_GET["signedup"]) && $_GET["signedup"] =="false" )
        {
            echo '<div class="container_fluid" style="  position: absolute; z-index: 100; width:100%;  ">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>sorry!</strong> You are not signedup.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div> ';
        } 
        
        // when recaptcha fails
    if( isset( $_GET["recaptcha"]) && $_GET["recaptcha"] =="false" )
        {
            echo '<div class="container_fluid" style="  position: absolute; z-index: 100; width:100%;  ">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>sorry! </strong> You have failed recaptcha please try again.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div> ';
        } 


        if( isset( $_GET["logout"]) && $_GET["logout"] =="true" )
        {
            echo '<div class="container_fluid" style="  position: absolute; z-index: 100; width:100%;  ">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>success!</strong> You are successfuly logged out.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div> ';
        } 
   


        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true)
        {
            echo '<div class="container_fluid" style="  position: absolute; z-index: 100; width:100%;  ">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>congrats!</strong> '.$_SESSION["username"].'  You are logged in.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div> ';
        }

        
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== false)
        {
            echo '<div class="container_fluid" style="  position: absolute; z-index: 100; width:100%;  ">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Sorry!</strong> no such user exist please login first.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div> ';
        session_unset();
        session_destroy();
        }
        if(isset($_SESSION['password']) && $_SESSION['password']== false)
        {
            echo '<div class="container_fluid" style="  position: absolute; z-index: 100; width:100%;  ">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Sorry!</strong> your password does not match.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div> ';
        session_unset();
        session_destroy();
        }
    ?>




    <?php
    // writing a php function to get different images automatically from unsplash by changing the category name after ? in the src of img tag 
            function unsplash_img()  {
                // storing category names as array in a variable
                $a=array("HTML","CSS","JAVASCRIPT","PHP","BOOTSTRAP","CODING","C++","C#",".NET");
                // taking only three values from above variable which is storing the different names
                $random_keys=array_rand($a,3);

                // loop to get the three values one by one and storing it into the variable to use it in a link 
                // this variable will return the values to a function so whenever the function is called these values
                for($i = 0;$i<=count($random_keys);$i++)
                {
                    $j= $a[$random_keys[$i]];
                    while($j)
                    {
                        break;
                    }
                    return $j;
                }
            }
    ?>



    <!-- carousel on top  start-->
    <section style="width: 100%;">
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                    aria-label="Slide 4"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <?php 
                        echo '
                        <img src="https://source.unsplash.com/1600x650/?'. unsplash_img() .'" class="d-block w-100" alt="an image is here">
                        ';
                    ?>
                </div>
                <div class="carousel-item">
                    <?php 
                        echo '
                        <img src="https://source.unsplash.com/1600x650/?'. unsplash_img() .'" class="d-block w-100" alt="an image is here">
                        ';
                    ?>
                </div>
                <div class="carousel-item">
                    <?php 
                        echo '
                        <img src="https://source.unsplash.com/1600x650/?'. unsplash_img() .'" class="d-block w-100" alt="an image is here">
                        ';
                    ?>
                </div>
                <div class="carousel-item">
                    <?php 
                        echo '
                        <img src="https://source.unsplash.com/1600x650/?'. unsplash_img() .'" class="d-block w-100" alt="an image is here">
                        ';
                    ?>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- carousel on top  end-->





    
    <!-- <section>
        <div class="container text-center mt-5">
            <h2>Welcome to iDiscuss Forum</h2>
            <hr>

            <small>Please Select Any Category Of Your Interest From Below!</small>
            <hr>
            <div class="row ms-5 mt-5" >

        fetching values of categories table from the database where every thread of any topics is present
        $sql="SELECT * FROM `categories`";
        $result=mysqli_query($conn , $sql);
        using loop to get all the values of each thread and to iterate the each card to display each and every thread seperately
        while($row=mysqli_fetch_assoc($result))
        {
        storing database values in some variable
          $cat_id = $row["category_id"];
          $cat_name = $row["category_name"];
          $cat_description = $row["category_description"];
          iterating the card and forwarding the categry values/data got from the database
          echo '        
            <div class="col-md-4 mt-5 " >
                <a href="../Project2/others/thread_category.php?catid='.$cat_id.'&catname='.$cat_name.' ">
                    <div class="card mainpagecards" style="width: 18rem;">
                        <img src="https://source.unsplash.com/1200x900/?'. unsplash_img() .'" class="card-img-top" alt="an image is here">
                        <div class="card-body">
                            <h5 class="card-title" style="color: black;">'.$cat_name.'</h5>
                            <p class="card-text "style="color: black;">'.substr($cat_description, 0 , 25 ).'....</p>
                            <a href="../Project2/others/thread_category.php?catid='.$cat_id.'&catname='.$cat_name.' " class="btn btn-primary mt-1">Open Thread</a>
                            </div>
                    </div>
                </a>
                </div>
              ';
            }
            </div>
        </div>
    </section>
     -->



    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- cards to show the every thread on main page -->



    <section>
    <div class="container text-center mt-5">
        <h2>Welcome to iDiscuss Forum</h2>
        <hr>
        <small>Please Select Any Topic Of Your Interest From Below!</small>
        <hr>
        <div class="row ms-5 mt-5">
            <?php
            $cardsPerPage = 5; // Number of cards to display per page
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page from the URL parameter

            // Calculate the offset to fetch the right set of cards
            $offset = ($currentPage - 1) * $cardsPerPage;

            // Fetch values from the categories table with a limit
            $sql = "SELECT * FROM `categories` LIMIT $offset, $cardsPerPage";
            $result = mysqli_query($conn, $sql);

            // Iterate through the cards to display
            while ($row = mysqli_fetch_assoc($result)) {
                $cat_id = $row["category_id"];
                $cat_name = $row["category_name"];
                $cat_description = $row["category_description"];

                echo '        
                <div class="col-md-4 mt-5">
                    <a href="../Project2/others/thread_category.php?catid=' . $cat_id . '&catname=' . $cat_name . '">
                        <div class="card mainpagecards" style="width: 18rem;">
                            <img src="https://source.unsplash.com/1200x900/?' . unsplash_img() . '" class="card-img-top" alt="an image is here">
                            <div class="card-body">
                                <h5 class="card-title" style="color: black;">' . $cat_name . '</h5>
                                <p class="card-text "style="color: black;">' . substr($cat_description, 0, 25) . '....</p>
                                <a href="../Project2/others/thread_category.php?catid=' . $cat_id . '&catname=' . $cat_name . '" class="btn btn-primary mt-1">Open Thread</a>
                            </div>
                        </div>
                    </a>
                </div>';
            }
            ?>
        </div>

        <!-- Pagination -->
        <div class="mt-5 d-flex justify-content-center "  >
            <?php
            $sql = "SELECT COUNT(*) FROM `categories`";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($result);
            $totalCards = $row[0];
            $totalPages = ceil($totalCards / $cardsPerPage);

            if ($totalPages > 1) {
                echo '<ul class="pagination shadow p-2  bg-body-primary rounded">';
                if ($currentPage > 1) {
                    echo '<li class="page-item"><a style="color: black !important;" class="page-link" href="?page=' . ($currentPage - 1) . '">Previous</a></li>';
                }
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo '<li class="page-item';
                    if ($i == $currentPage) echo ' active';
                    echo '"><a style="color: black !important;" class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                }
                if ($currentPage < $totalPages) {
                    echo '<li class="page-item"><a style="color: black !important;" class="page-link" href="?page=' . ($currentPage + 1) . '">Next</a></li>';
                }
                echo '</ul>';
            }
            ?>
        </div>
    </div>
</section>





    <?php
    require "partials/_footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>


 <!-- Materialize JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>



</body>

</html>