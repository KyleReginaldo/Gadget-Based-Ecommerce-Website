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
        input:focus{
            outline: none;
            border: 1px solid blue;
        }
        button{
            width: 100%;
        }
        
        .login-body{
            display:flex;
            justify-content: center;
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
        small{
            font-weight: 600;
            font-size: 1rem;
            margin: 0;
            padding: 0;
        }
        .forgot-password{
            font-size: 0.8rem;
            color: black;
            cursor: pointer;
        }
    </style>
</head>

<body class="hold-transition skin-blue layout-top-nav">
   <div class="wrapper">
    <div class="login-body">
        <div class="right-side">
            <img src="images/logo.png" alt="">
            <p>Sign in for faster checkout.</p>
            <small>Sign in to Jambol</small>
            <form action="verify.php" method="POST">
                <label for="email">Email</label>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <label for="password">Password</label>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <a href=""><small class="forgot-password">Forgotten your password?</small></a>
                <button type="submit" class="button-auth btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
            </form>
            <medium class="text-center">Don't have an account? <a href="signup.php">Sign Up</a></medium>
        </div>
   </div>
   </div>
</body>
</html>