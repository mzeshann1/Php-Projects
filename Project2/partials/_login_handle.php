<?php
// connecting to the database
require "_dbconnect.php";

// Getting the erecaptcha response is being post submit or not

if(isset($_POST['g-recaptcha-response'])){

  // google recaptcha parameters
  $secret = "6Le4NsAoAAAAAHLksVMyzCpAVZFCfG8AqQeTcN5z";
  $remoteip = $_SERVER['REMOTE_ADDR'];
  $response = $_POST['g-recaptcha-response'];
  $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
  $fire=file_get_contents($url);
  $data= json_decode($fire);
  
  // if recaptcha is successful then go for form validation and do insertion
  if ($data->success == true) 
  {
      // echo "success";
      // recaptcha is success now go for the form post submission
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
      // getting email
      $log_email=$_POST["inp_log_email"];
      $log_email=str_replace("<","&lt",$log_email);
      $log_email=str_replace(">","&gt",$log_email);

      // getting password
      $log_password=$_POST["inp_log_password"];
      $log_password=str_replace("<","&lt",$log_password);
      $log_password=str_replace(">","&gt",$log_password);


      // checking from the database if this email is found
      $sql="SELECT * FROM users WHERE user_email = '$log_email';";
      $result=mysqli_query($conn , $sql);
      $num_rows= mysqli_num_rows($result);

      // if one row of that email exists
      if($num_rows == 1)
      {
        // fetching all the data of that row 
        while($result_rows= mysqli_fetch_assoc($result))
        {
          $num_rows=$result_rows;
          $username=$num_rows["user_first_name"];
          $user_sno=$num_rows["sno"];

          // verifying the password
          // password true the start session and take username and serial no
          if(password_verify(  $log_password , $num_rows['user_password']))
          {
            session_start();
            $_SESSION['loggedin']= true;
            $_SESSION['username']=$username;
            $_SESSION['user_sno']=$user_sno;
            header("location:/zeeshan_projects/Project2/index.php");
            exit();
          }
          // session start and take passsword as false to show the alert
          else
          {
            session_start();
            $_SESSION['password']= false;
            header("location:/zeeshan_projects/Project2/index.php");
            exit();
            }
          }
        }
        else
        {
            session_start();
            $_SESSION['loggedin']= false;
            header("location:/zeeshan_projects/Project2/index.php");
            exit();
        }
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
