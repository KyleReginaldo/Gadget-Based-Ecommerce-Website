<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: cart_view.php');
  }
?>
<?php include 'includes/header.php';?>
<style>
    .login-box{
      background-color: red;
      background-image: url(images/bg-login.jpg);
    }
    .button-auth{
      background-color: blue;
    }
    .login-box, .login-box-body{
      border-radius: 8px; 
    }
    .login-page{
      /* background-color: lightgrey; */
    }
  </style>
<body class="hold-transition login-page">
<div class="login-box" >
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
        unset($_SESSION['success']);
      }
    ?>
  	<div class="login-box-body">
    	<p class="login-box-msg">Sign in</p>
    	<form action="verify.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="email" class="form-control" name="email" placeholder="Email" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<button type="submit" class="button-auth btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
    	</form>
      <br>
      <a href="signup.php" class="register-text text-center">Register a new account</a><br>
      <a href="index.php"><i class="fa fa-home"></i> Home</a>
  	</div>
</div>
	
<?php include 'includes/scripts.php' ?>
<style>
  .register-text:hover{
    color:black;
    font-weight: 600;
  }
</style>
</body>
</html>