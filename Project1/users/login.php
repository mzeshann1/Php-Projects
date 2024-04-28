<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css"
        rel="stylesheet">
  </head>
  <body>

    <?php
    require "../partials/_dbconnect.php";
    require "../partials/_navbar.php";
    ?>

    

    <?php
    
    $login=false;
    $showerror=false;
    $loggedin=false;

    if($_SERVER["REQUEST_METHOD"]== "POST")
    {
      $user_email=$_POST["inp_email"];
      $user_password=$_POST["inp_password"];
      $sql="SELECT * FROM `users` where email = '$user_email'";
      $result=mysqli_query($conn , $sql);
      $num=mysqli_num_rows($result);

      if($num == 1)
      {
        while($row= mysqli_fetch_assoc($result))
        {
          if(password_verify(  $user_password , $row['password']))
          {
            
            $login=true;
            session_start();
            $_SESSION['loggedin']= true;
            $_SESSION['username']=$username;
            header("location:../notepad.php");


          }
          else
          {
            $showerror=true;
            }
        }
      }
      else
      {
      $showerror=true;
       }
    }
    ?>



    <?php
        if($login==true)
        {
          echo '<div class="alert alert-primary" role="alert">
          You are logged in 
        </div>';
        } 

        if($showerror==true)
        {
          echo '<div class="alert alert-danger" role="alert">
          Your password does not match
        </div>';
        } 
    
    
    
    ?>








    <style>
      body {
          background-color: #dee9ff !important;
      }
      .registration-form {
          padding: 50px 0 !important;
      }
      .registration-form form {
          background-color: #fff !important;
          max-width: 600px !important;
          margin: auto !important;
          padding: 50px 70px !important;
          border-top-left-radius: 30px !important;
          border-top-right-radius: 30px !important;
          box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075) !important;
      }
      .registration-form .form-icon {

          text-align: center !important;
          background-color: #5891ff !important;
          border-radius: 50% !important;
          font-size: 40px !important;
          color: white !important;
          width: 100px !important;
          height: 100px !important;
          margin: auto !important;
          margin-bottom: 50px !important;
          line-height: 100px !important;
      }
      .registration-form .item {
          border-radius: 20px !important;
          margin-bottom: 25px !important;
          padding: 10px 20px !important;

      }
      .registration-form .create-account {

          border-radius: 30px !important;
          padding: 10px 20px !important;
          font-size: 18px !important;
          font-weight: bold !important;
          background-color: #5791ff !important;
          border: none !important;
          color: white !important;
          margin-top: 20px !important;
      }
      .registration-form .social-media {
          max-width: 600px !important;
          background-color: #fff !important;
          margin: auto !important;
          padding: 35px 0 !important;
          text-align: center !important;
          border-bottom-left-radius: 30px !important;
          border-bottom-right-radius: 30px !important;
          color: #9fadca !important;
          border-top: 1px solid #dee9ff !important;
          box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075) !important;
      }
      .registration-form .social-icons {
          margin-top: 30px !important;
          margin-bottom: 16px !important;
      }
      .registration-form .social-icons a {
          font-size: 23px !important;
          margin: 0 3px !important;
          color: #5691ff !important;
          border: 1px solid !important;
          border-radius: 50% !important;
          width: 45px !important;
          display: inline-block !important;
          height: 45px !important;
          text-align: center !important;
          background-color: #fff !important;
          line-height: 45px !important;
      }
      .registration-form .social-icons a:hover {
          text-decoration: none !important;
          opacity: 0.6 !important;
      }
      .cb {
          display: flex;
          justify-content: center;
      }
      @media (max-width: 576px) {
          .registration-form form {
              padding: 50px 20px !important;
          }
          .registration-form .form-icon {
              width: 70px !important;
              height: 70px !important;
              font-size: 30px !important;
              line-height: 70px !important;
          }
      }
    </style>




    <div class="registration-form">
      <form method="post" action="">
          <div class="form-icon">
              <span><i class="icon icon-user"></i></span>
          </div>
          <div style="display: flex; justify-content: center;">
              <h2><i>Login Here</i></h2>
          </div>
          <br>
          <div class="form-group">
              <input type="email" class="form-control item" id="inp_email" name="inp_email" placeholder="Email"
                  required>
          </div>
          <div class="form-group">
              <input type="password" class="form-control item" id="inp_password" name="inp_password"
                  placeholder="Password" required>
          </div>
          <div class="form-group cb">
              <button type="submit" class="btn btn-block create-account">Login</button>
              <button type="reset" class="btn btn-block create-account">Clear</button>
          </div>
      </form>

  </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>



  </body>
</html>