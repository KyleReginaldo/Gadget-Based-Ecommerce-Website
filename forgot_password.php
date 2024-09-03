
<?php require("script.php"); ?>
<?php
    include 'includes/session.php';
    $conn = $pdo->open(); 
    $randomNumber = rand(100000, 999999);
    if(isset($_POST['submit'])){
        if(empty($_POST['email'])){
            $response = "All fields are required";
        }else{
            
            try{
                $stmt = $conn->prepare("SELECT * FROM users WHERE email=:email");
                $stmt->execute(['email'=>$_POST['email']]);
                if($stmt->rowCount() > 0){
                    $stmt = $conn->prepare("UPDATE users SET otp=:otp WHERE email=:email");
                    $stmt->execute(['email'=>$_POST['email'],'otp'=>$randomNumber]);
                    $response = sendMail($_POST['email'],$randomNumber,'Recover your password code: '.$randomNumber);
                }else{
                    $response = 'There is no existing account with this email.';
                }
            }
            catch(PDOException $e){
                $response = 'There is no corresponding account to this email';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
   margin: 0;
   padding: 0;
   box-sizing: border-box;
}
 
body{
   font-family: sans-serif;
   min-height: 100%;
   color: #555;
}
 
form{
   max-width: 400px;
   margin: 50px auto 0 auto;
   border:  thin solid #e4e4e4;
   padding: 20px;
   box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
}
 
form .info{
   font-weight: bold;
   margin-bottom: 30px;
   text-align: center;
   font-size: 24px;
}
 
form label{
   display: block;
   margin-bottom: 10px;
   padding-left: 5px;
}
 
form input, form textarea{
   display: block;
   width:  100%;
   padding: 10px;	
   margin-bottom: 10px;
   font-size: 16px;
   border:  thin solid #e4e4e4;
   margin-bottom: 0.5rem;
   border-radius: 8px;
}
 
form input:focus,
form select:focus,
form textarea
{
   outline: none;
}
 
form textarea{
}
 
form input::placeholder{
}
 
form button{
   background: blue;
   color: white;
   border: none;	
   padding: 0.6rem 1rem;
   width:  100%;
   font-size: 16px;
   cursor: pointer;
   border-radius: 8px;
}
 
form button:active{
   background-color: green;
}
 
.error{
   margin-top: 30px;
   color: #af0c0c;
}
 
.success{
   margin-top: 30px;
   color: green;
}
</style>
</head>
<body>
    <?php
        if(@$response == "success"){
            ?>
                <form action="send_otp.php" method="post">
                    <p>Enter OTP</p>
                    <br>
                    <input type="text" placeholder="new password" name="new-password">
                    <input type="text" placeholder="enter code" name="otp">
                    <button type="submit" name="submit">Submit</button>
                    <?php
                    if(!@$otpResponse){
                        ?>
                            <p class="success"><?php echo @$otpResponse; ?></p>
                        <?php
                    }
                ?>
                </form>
            <?php
        }
    ?>
    <?php
    if(!@$response){
        ?>
        <form action="" method="post">
            <div class="info">
                Recover your password
            </div>
            
            <label>Enter your email</label>
            <input type="email" name="email" value="" placeholder="enter your email">
            
            <button type="submit" name="submit">Submit</button>
                <?php
                    if(@$response == "success"){
                        ?>
                            <p class="success"></p>
                        <?php
                    }else{
                        ?>
                            <p class="error"><?php echo @$response; ?></p>
                        <?php
                    }
                ?>
        </form>
        <?php
        }
        ?>
</body>
</html>