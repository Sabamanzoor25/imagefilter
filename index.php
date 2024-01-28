<?php
include_once 'DB/db.php';
//Register Client
if (isset($_POST['reg'])) {

    $username = $_POST['username'];
 
    $email=$_POST['email'];
    $password=$_POST['password'];
   
    $regex = '/^[_a-zA-Z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
    $regex2='/^\d{11,11}$/';
    if (!preg_match($regex, $email))
    {
        $message = "Email Address not Correct eg:xyz@abc.xyz";
        echo "<script>  alert('$message');window.location.href='index.php'; </script>";
    }
    
     $sql1 = "SELECT email FROM register WHERE email='$email'";

    $result = $conn->query($sql1);
    if ($result->num_rows > 0)
    {
        $message = "User already Registered Try Again";
        echo "<script>  alert('$message');window.location.href='index.php'; </script>";
    }
    else
    {
        $sql2 = "SELECT rid FROM register ORDER BY rid LIMIT 1 ";
        $result = $conn->query($sql2);
        $row = $result->fetch_assoc();
      
    

        $sql3 = "INSERT INTO `register` (`username`, `email`, `password`) VALUES ('$username','$email','$password')";
         if ($conn->query($sql3) === TRUE)
         {
          $idd= $row['rid'];
          $idd=$idd+1;
                // Display the alert box
                $message = "New record created successfully";
                echo "<script>  alert('$message');window.location.href='index.php'; </script>";
              
            }
         else
         {
                echo "Error: " . $sql3 . "<br>" . $conn->error;
            }
        $conn->close();
    }
}


//USER LOGIN BUTTON
if(isset($_POST['login']))
{
    //  $_SESSION["PatientLogin"] = "yellow";
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql4 = "SELECT * FROM `register` WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql4);
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $_SESSION['login'] = $row['rid'];
        }
        echo "<script>window.location.href='project/index.html'; </script>";
    }
    else
    {
        $_SESSION['login']=[];
        $m = 'AUTHENTICATION FAILED TRY AGAIN';
        echo "<script>  alert('$m');window.location.href='index.php'; </script>";
    }
}

                    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/64d58efce2.js"crossorigin="anonymous" ></script>
    <link rel="stylesheet" href="project/style2.css">

    <title>Document</title>
</head>
<body>
   
    <div class="container">
        <div class="forms-container">
          <div class="signin-signup">
          <form action="index.php"  method='post'class="sign-in-form">
              <h2 class="title">Sign in</h2>
              <div class="input-field"><i class="fas fa-user"></i>
                <input type="text"  name='email'  placeholder="Enter Email" autocomplete='off'     style="border-radius:2px;">
              </div>
              <div class="input-field"> <i class="fas fa-lock"></i>
                <input type="password" name='password' placeholder="Enter Password" />
              </div>
              <input type="submit" value="Login" name='login' class="btn solid"/>
              <p class="social-text">Or Sign in with social platforms</p>
              <div class="social-media">
                <a href="#" class="social-icon"> <i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"> <i class="fab fa-twitter"></i> </a>
                <a href="#" class="social-icon"> <i class="fab fa-google"></i> </a>
                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i>  </a>
              </div>
            </form>



            <form action="index.php" method="POST" class="sign-up-form">
              <h2 class="title">Sign up</h2>
              <div class="input-field" > <i class="fas fa-user"></i>
                <input type="text" name='username'  pattern="[a-zA-Z0-9]+"  placeholder='Username' />
              </div>
              <div class="input-field"> <i class="fas fa-envelope"></i>
                <input type="email" name='email'placeholder="Email" autocomplete="on" />
              </div>
              <div class="input-field"> <i class="fas fa-lock"></i>
                <input type="password" name='password' placeholder="Password" />
              </div>
              <input type="submit" class="btn" value="Sign up"  name="reg"/>
              <p class="social-text">Or Sign up with social platforms</p>
              <div class="social-media">
                <a href="#" class="social-icon"> <i class="fab fa-facebook-f"></i> </a>
                <a href="#" class="social-icon"> <i class="fab fa-twitter"></i>  </a>
                <a href="#" class="social-icon"> <i class="fab fa-google"></i> </a>
                <a href="#" class="social-icon"> <i class="fab fa-linkedin-in"></i></a>
              </div>
            </form>
          </div>
        </div>
  
        <div class="panels-container">


          <div class="panel left-panel">
            <div class="content">
              <h3>New here ?</h3>
              <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                Debitis,
                ex ratione. Aliquid!
              </p>
              <button class="btn transparent" id="sign-up-btn">
                Register
              </button>
            </div>
         
          </div>
          <div class="panel right-panel">
            <div class="content">
              <h3 class="c2">One of us ?</h3>
              <p class="para">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                Nostrum laboriosam ad deleniti.
              </p >
              <button class="btn2 transparent2" id="sign-in-btn">
                Log in
              </button>
            </div>
         
          </div>
        </div>



   </div>
  
      <script src="project/app.js"></script>
    </body>
  </html>