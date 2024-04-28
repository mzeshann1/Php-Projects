<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NAVBAR</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="../design/_design.css">

</head>

<body>
  <?php

// checking the session and giving some variables to be true to shown the nav accordingly down with required condition

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true)
{
    $loggedin=true;
}
else
{
    $loggedin=false;
}

echo "    <nav class='navbar navbar-expand-lg '>
<div class='container-fluid'>
    <a class='navbar-brand' href='#'>Notepad</a>
    <button class='navbar-toggler' type='button' data-bs-toggle='collapse'
        data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false'
        aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <ul class='navbar-nav d-flex ms-5 me-auto mb-2 mb-lg-0'>

        ";

        if($loggedin)
        {
            echo "                <li class='nav-item ms-4'>
            <a class='nav-link ' aria-current='page' href='../Project1/notepad.php'>Home</a>
        </li>
        <li class='nav-item ms-4'>
            <a class='nav-link' href='../Project1/about.php'>About</a>
        </li>";
        }
        
        
        echo "</ul>
        <ul class='navbar-nav d-flex  ms-5  mb-2 mb-lg-0 '>



           ";
           if($loggedin)
           {
            echo " <li class='nav-item ms-4'>
                <a class='nav-link' href='/zeeshan_projects/Project1/users/login.php'>Logout</a>
            </li>
            ";


           }
            if(!$loggedin)
            {
                echo "<li class='nav-item ms-4'>
                <a class='nav-link' href='../users/login.php'>Login</a>
            </li> 

            <li class='nav-item ms-4'>
                <a class='nav-link' href='../users/signup.php'>signup</a>
            </li>";
            }
            echo "
        </ul>

    </div>
</div>
</nav>";


?>











  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
</body>

</html>