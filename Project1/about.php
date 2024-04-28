<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!= true)
{
  header("location:login.php");
  exit;
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>About Us</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../Project1/design/_design.css">
</head>
<body>
    <?php
    require "partials/_navbar.php";
    require "partials/_dbconnect.php";

    ?>

  <div class="container" style="margin-top: 6%;">
    <section id="about-section">
      <div class="row">
        <div class="col-md-6">
          <h2>Welcome to Notepad</h2>
          <p>
            Notepad is a revolutionary online text editor that aims to transform the way you write, collaborate, and organize your work. We provide a seamless and intuitive platform that caters to the needs of writers, students, professionals, and creative minds.
          </p>
        </div>
        <div class="col-md-6">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4ZuFgySTnnUmifGj8ahHPH9iaDQMDu-_kGg&usqp=CAU" alt="Notepad Image" class="img-fluid">
          
        </div>
      </div>
    </section>

    <section id="vision-section">
      <h2>Our Vision</h2>
      <p>
        Our vision is to empower individuals and teams to unlock their full writing potential. We believe in providing a creative and supportive environment where ideas can thrive, knowledge can be shared, and stories can be brought to life.
      </p>

      <h2>Our Mission</h2>
      <p>
        Our mission is to offer a user-friendly and feature-rich platform that enhances the writing experience. We strive to continually innovate and improve our services, enabling users to streamline their workflow, collaborate seamlessly, and create remarkable content.
      </p>
    </section>

    <section id="features-section">
      <h2>Features</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4ZuFgySTnnUmifGj8ahHPH9iaDQMDu-_kGg&usqp=CAU" class="card-img-top" alt="Feature 1">
            <div class="card-body">
              <h5 class="card-title">Intuitive Interface</h5>
              <p class="card-text">Our user-friendly interface ensures a seamless writing experience, allowing you to focus on your content.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4ZuFgySTnnUmifGj8ahHPH9iaDQMDu-_kGg&usqp=CAU" class="card-img-top" alt="Feature 2">
            <div class="card-body">
              <h5 class="card-title">Real-time Collaboration</h5>
              <p class="card-text">Collaborate with others in real-time, making it perfect for group projects and team collaborations.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4ZuFgySTnnUmifGj8ahHPH9iaDQMDu-_kGg&usqp=CAU" class="card-img-top" alt="Feature 3">
            <div class="card-body">
              <h5 class="card-title">Cloud Storage</h5>
              <p class="card-text">Store and access your documents securely from anywhere, ensuring your work is always available.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="team-section">
      <h2>Meet Our Team</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOuxrvcNMfGLh73uKP1QqYpKoCB0JLXiBMvA&usqp=CAU" class="card-img-top" alt="Team Member 1">
            <div class="card-body">
              <h5 class="card-title">John Doe</h5>
              <p class="card-text">Co-founder & CEO</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOuxrvcNMfGLh73uKP1QqYpKoCB0JLXiBMvA&usqp=CAU" class="card-img-top" alt="Team Member 2">
            <div class="card-body">
              <h5 class="card-title">Jane Smith</h5>
              <p class="card-text">Co-founder & CTO</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOuxrvcNMfGLh73uKP1QqYpKoCB0JLXiBMvA&usqp=CAU" class="card-img-top" alt="Team Member 3">
            <div class="card-body">
              <h5 class="card-title">David Johnson</h5>
              <p class="card-text">Lead Developer</p>
            </div>
          </div>
        </div>
      </div>
    </section>


  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
