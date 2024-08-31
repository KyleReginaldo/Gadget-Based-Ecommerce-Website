<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        *{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        body{
            /* background-color: blue; */
            background-image: url(images/jambol-banner.png);
        }
        input, button{
            padding: 0.5rem 0.5rem;
            margin: 0.5rem 0;
            width: 400px;
        }
        button{
            width: 100%;
        }
        
        .login-body{
            display:flex;
            justify-content: end;
            align-items: center;
            height: 100vh;
            width: 100vw;
        }
        .right-side img{
            width: 128px;
        }
        .right-side{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: rgba(255,255,255,0.9);
            padding: 2rem 4rem;
            height: 90%;
            margin: 0 10rem;
            border-radius: 8px;
        }
        .right-side p{
            font-size: 24px;
            font-weight: 600;
        }
        .right-side small{
            margin-bottom: 2rem;
        }
        .right-side a{
            color: black;
            text-decoration: none;
            font-weight: 600;
            transition: font-size 0.2s ease-in-out;
        }
        .right-side a:hover{
            color: blue;
        }
        .button-auth{
            background-color: blue;
            border: none;
            color: white;
        }
    </style>
</head>

<body class="hold-transition skin-blue layout-top-nav">
   <div class="wrapper">
    <div class="login-body">
        <div class="right-side">
            <?php
              if(isset($_SESSION['error'])){
                echo "
                  <div class='callout callout-danger text-center'>
                    <p>".$_SESSION['error']."</p> 
                  </div>
                ";
                unset($_SESSION['error']);
              }

              if(isset($_SESSION['success'])){
                echo "
                  <div class='callout callout-success text-center'>
                    <p>".$_SESSION['success']."</p> 
                  </div>
                ";
                header('location: login.php');
                unset($_SESSION['success']);
              }
            ?>
            <img src="images/logo.png" alt="">
            <p>Welcome Back!</p>
            <small>Enter your details</small>
            <form action="register.php" method="POST">
                <label for="email">First name</label>
                <div class="form-group has-feedback">
                  <input type="text" class="form-control" name="firstname" placeholder="Firstname" value="<?php echo (isset($_SESSION['firstname'])) ? $_SESSION['firstname'] : '' ?>" required>
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <label for="email">Last name</label>
                <div class="form-group has-feedback">
                  <input type="text" class="form-control" name="lastname" placeholder="Lastname" value="<?php echo (isset($_SESSION['lastname'])) ? $_SESSION['lastname'] : '' ?>"  required>
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <label for="email">Email</label>  
                <div class="form-group has-feedback">
                  <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo (isset($_SESSION['email'])) ? $_SESSION['email'] : '' ?>" required>
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <label for="email">Password</label>
                <div class="form-group has-feedback">
                  <input type="password" class="form-control" name="password" placeholder="Password" required>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <label for="email">Re-type Password</label>
                <div class="form-group has-feedback">
                  <input type="password" class="form-control" name="repassword" placeholder="Retype password" required>
                  <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <button type="submit" class="button-auth btn btn-primary btn-block btn-flat" name="signup"><i class="fa fa-pencil"></i> Sign Up</button>
            </form>
            <medium class="text-center">Already have account? <a href="login.php">Sign In</a></medium>

        </div>
   </div>
   </div>
</body>
</html>