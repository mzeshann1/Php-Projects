<style>
    a{
        color: white !important;
    }
    button{
        color: white !important;
    }

</style>

<?php




echo '
<nav class="navbar navbar-expand-lg  "  style=" background-color: #6351ce;"   >
<div class="container-fluid " >
  <a class="navbar-brand "  href="/zeeshan_projects/Project2/index.php">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/zeeshan_projects/Project2/index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/zeeshan_projects/Project2/others/about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Top Topics
        </a>
        <ul class="dropdown-menu mt-2">
        ';

        $sql="SELECT category_name , category_id FROM `categories` LIMIT 5";
        $result=mysqli_query($conn , $sql );
        
        while($row=mysqli_fetch_assoc($result))
        {
          $cat_id = $row['category_id'];
          $cat_name = $row['category_name'];

          // Construct the URL based on the current page
          $current_page = basename($_SERVER['PHP_SELF']);  // Get the current page filename
          $base_url = 'http://localhost/Zeeshan_Projects/Project2';

          if ($current_page == 'thread_category.php') {
            $link_url = "$base_url/others/thread_category.php?catid=$cat_id&catname=$cat_name";
          } else {
              $link_url = "$base_url/others/thread_category.php?catid=$cat_id&catname=$cat_name";
          }
          echo '<a href="'.$link_url.'" class="dropdown-item" style="color: black !important;">'.$cat_name.'</a>';

        }
          
          echo '
          </ul>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="/zeeshan_projects/Project2/others/contact.php">Contact</a>
      </li>
    </ul>
    
    <form class="d-flex " method="get" action="/zeeshan_projects/Project2/partials/_search.php" role="search">
        <input class="form-control me-2" name="search" required type="search" placeholder="Search Topics" aria-label="Search">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
      <br>
    <div class="mx-2">';


    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true)
    {
      echo ' <a class="btn btn-primary " href="/zeeshan_projects/Project2/partials/_logout.php"  >logout</a>';
      echo ' <a class="btn btn-primary " > <span>WELCOME</span>&nbsp; <span style="text-transform:lowercase;">'.$_SESSION["username"].' </span></a>';

    }
    else
    {
      
      echo'
      <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#login_modal">Login</button>
      <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#signup_modal">Signup</button>
      ';
    }

    echo '
    </div>
  </div>
</div>
</nav>';








?>