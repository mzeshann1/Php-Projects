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
    <link rel="stylesheet" href="../partials/index.css">
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
        require "_dbconnect.php";
        // including the navbar
        require "_header.php";
        // including the login functionality page with login form
        require "_login.php";
        // including the signup functionality page with signup form
        require "_signup.php";
    ?>

    <?php
        // Get the current page from the URL parameter
        $search = $_GET['search'];
        // saving it from the xss by this no js scripts will be executed upon form submission
        $search=str_replace("<","&lt",$search);
        $search=str_replace(">","&gt",$search);
    ?>



    <div class="container-fluid d-flex flex-column justify-content-center align-items-center">
        <div class="search  mt-5">
            <h1><b><u>Search Results</u></b></h1>
            <h6 class="text-center mt-4 mb-3">Your Search Results For <em><b> <?php echo " \" ".$search." \" "?></b> </em> </h6>
            <hr>
        </div>
        <div class="row ps-5 pe-5">
        <?php
            // Prevent SQL injection by using prepared statements
            $sql = "SELECT * FROM `categories` WHERE (category_name ) LIKE ? ";
            // $sql = "SELECT * FROM `categories` WHERE MATCH (category_name, category_description) AGAINST (? IN BOOLEAN MODE)";
            $stmt = mysqli_prepare($conn, $sql);
                if ($stmt) 
                {
                    // Bind the search term to the query using a wildcard for searching
                    // doing this because the special characters were not showing like + with c++ or # with c#
                    $searchTerm = "%" . $search . "%";
                    mysqli_stmt_bind_param($stmt, "s", $searchTerm);
                    // Execute the query
                    mysqli_stmt_execute($stmt);
                    // Get the result set
                    $result = mysqli_stmt_get_result($stmt);
                    $check=false;
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
                        $check=true;
                        $cat_id = $row["category_id"];
                        $cat_name = $row["category_name"];
                        $cat_description = $row["category_description"];
                        echo '
                                <div class="col-md-6 d-flex justify-content-center  mt-5">
                                    <a href="../others/thread_category.php?catid=' . $cat_id . '&catname=' . $cat_name . '">
                                        <div class="card mainpagecards " id="search_mainpagecards" style="width: 40rem;">
                                            <div class="card-body">
                                                <h3 class="card-title text-center" style="color: black;"><u>' . $cat_name . '</u></h3>
                                                <br>
                                                <p class="card-text "style="color: black;">' . substr($cat_description, 0, 180) . '....</p>
                                            </div>
                                            <div class="p-2 d-flex justify-content-center align-items-center" >
                                                <a  href="../others/thread_category.php?catid=' . $cat_id . '&catname=' . $cat_name . '" class="btn btn-primary ">Open Thread</a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            ';
                    }
                    if($check == false)
                    {
                        echo"
                        <div class='mt-3'>
                            <h1 > Sorry No Result Has Been Found</h1>
                            <ul class='p-1' >
                                <li>Make sure that all words are spelled correctly.</li>
                                <li>Try different keywords.</li>
                                <li>Try more general keywords.</li>
                            </ul>
                        </div>
                        ";
                    }
                    else
                    {
                        // when $check is true 
                        // no need to add as the reuslts are already shown
                    }
                } 
                else 
                {
                    // Handle the case where the prepared statement fails
                    echo "Error in the query.";
                }
        ?>   
        </div>
    </div>

    <?php
    require "_footer.php";
    ?>

    <!-- Materialize JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>