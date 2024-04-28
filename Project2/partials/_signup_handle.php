<?php


// the user is not already present and also the password and confirm password are same so now we will do the google recaptcha validation

// if (isset($_POST['submit'])) {
    //     $data = file_get_contents($url);
    //     $row = json_decode($data, true);
    //     if ($row['success'] == "true") {
        //     echo "<script>alert('Wow you are not a robot 😲');</script>";
        //     } 
        //     else {
            //     echo "<script>alert('Oops you are a robot 😡');</script>";
            //     exit();
            //     }
            
            // }
            
include "_dbconnect.php";


if(isset($_POST['g-recaptcha-response'])){
    $secret = "6Le4NsAoAAAAAHLksVMyzCpAVZFCfG8AqQeTcN5z";
    $remoteip = $_SERVER['REMOTE_ADDR'];
    $response = $_POST['g-recaptcha-response'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
    $fire=file_get_contents($url);
    $data= json_decode($fire);


    if ($data->success == true) {

        // if recaptcha is successful then go for form validation and do insertion
        // echo "success";
        
if($_SERVER["REQUEST_METHOD"]== "POST")
{
    $fname=$_POST["inp_fname"];
    $lname=$_POST["inp_lname"];
    $u_email=$_POST["inp_email"];
    $u_contact=$_POST["inp_contact_number"];
    $u_password=$_POST["inp_password"];
    $u_cpassword=$_POST["inp_confirm_password"];

    // checking if the user already exist 
    $exist_sql="SELECT * FROM users WHERE user_email = '$u_email';";
    $result=mysqli_query($conn , $exist_sql);
    $num_rows= mysqli_num_rows($result);
    if($num_rows>0)
    {
        // user already exists
        header("location:/zeeshan_projects/Project2/index.php?userexist=true");
        exit();
    }
    else{
        // user is new go further
        if($u_password==$u_cpassword){
            // password and confirm password are matched
            $hash=password_hash($u_password, PASSWORD_DEFAULT); 
            // now lets do insertion 
            $sql = "INSERT INTO `users` (`sno`, `user_first_name`, `user_last_name`, `user_email`, `user_contact`, `user_password`,`user_acc_created`) VALUES (NULL, '$fname', '$lname', '$u_email', '$u_contact', '$hash', current_timestamp())";
            $result=mysqli_query($conn, $sql);
                    if($result)
                    {
                    header("location:/zeeshan_projects/Project2/index.php?signedup=true&username=$fname");
                        exit();
                        }
                    else{
                        header("location:/zeeshan_projects/Project2/index.php?signedup=false");
                        exit();
                    }
        }
        else{
            header("location:/zeeshan_projects/Project2/index.php?passwordmatch=false");
            exit();
         }
    }
}
else{
    // request method is not post
}

    }
    
    else{
        // when recaptcha gets failed 
        // echo "please fill captcha";
        header("location:/zeeshan_projects/Project2/index.php?recaptcha=false");
        exit();
    }
                
}
else{
    // echo "recaptcha error";
}







?>

