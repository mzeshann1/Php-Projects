<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="../Project1/design/_design.css">
</head>
<body>

    <?php
    require "../partials/_navbar.php";
    require "../partials/_dbconnect.php";
    ?>



<!-- getting all the credentials to register the user  -->
    <?php

    $uexists=false;
    $pass = false;
    $signing=false;

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $ins_username=$_POST["inp_username"];
        $ins_email=$_POST["inp_email"];
        $ins_password=$_POST["inp_password"];
        $ins_cpassword=$_POST["inp_conpassword"];
        $ins_phone=$_POST["inp_phone"];
        $ins_birth=$_POST["inp_birth"];


        $exists="SELECT * FROM `users` where email = '$ins_email'";
        $result=mysqli_query($conn, $exists);
        $rows=mysqli_num_rows($result);

        if ($rows > 0) {
            $uexists=true;
            
        }
        else
        {
            if($ins_password == $ins_cpassword)
            {
                $hash=password_hash($ins_password, PASSWORD_DEFAULT); 
                // insertion query
                $sql="INSERT INTO `users` (`sno`, `username`, `email`, `password`, `phone`, `birthdate`) VALUES (NULL, '$ins_username', '$ins_email', '$hash', '$ins_phone', '$ins_birth')";

                $result=mysqli_query($conn , $sql);
                if($result)
                {
                    $signing = true;
                }
            }

            else{
                $pass=true;
            }
        }
        
    }    
    
    
    
    ?>

    <?php
    if($uexists)
    {
        echo '<div class="alert alert-warning alert-dismissible fade show"
      role="alert">
      <strong>Failed! </strong> This Email is already Registered .
      <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
    </div>';
    }
    if($pass)
    {
        echo '<div class="alert alert-warning alert-dismissible fade show"
      role="alert">
      <strong>Failed! </strong> Your Password do not match.
      <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
    </div>';
    }
    if($signing)
    {
        echo '<div class="alert alert-success alert-dismissible fade show"
      role="alert">
      <strong>Congratulations! </strong> Your Account has been created .
      <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
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
        <form method="post" action="../users/signup.php">
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            <div style="display: flex; justify-content: center;">
                <h2><i>Register Your Account Here</i></h2>
            </div>
            <br>
            <div class="form-group">
                <input type="text" class="form-control item" id="inp_username" name="inp_username"
                    placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control item" id="inp_email" name="inp_email" placeholder="Email"
                    required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="inp_password" name="inp_password"
                    placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="inp_conpassword" name="inp_conpassword"
                    placeholder="Confirm Password">
            </div>

            <div class="form-group">
                <input type="text" class="form-control item" id="inp_phone" name="inp_phone" placeholder="Phone Number"
                    required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="inp_birth" name="inp_birth"
                    placeholder="Birth Date (YYYY/MM/DD)" required>
            </div>
            <div class="form-group cb">
                <button type="submit" class="btn btn-block create-account">Signup</button>
                <button type="reset" class="btn btn-block create-account">Clear</button>
            </div>
        </form>
        <!-- <div class="social-media">
            <h5>Sign up with social media</h5>
            <div class="social-icons">
                <a href="#"><i class="icon-social-facebook" title="Facebook"></i></a>
                <a href="#"><i class="icon-social-google" title="Google"></i></a>
                <a href="#"><i class="icon-social-twitter" title="Twitter"></i></a>
            </div>
        </div> -->
    </div>





















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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#inp_birth').mask('0000/00/00');
            $('#inp_date').mask('0000-0000000');
        })
    </script>

</body>

</html>