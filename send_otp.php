
<?php
include 'includes/session.php';
$conn = $pdo->open(); 
$randomNumber = rand(100000, 999999);
$otp = $_POST['otp'];
$newPassword = $_POST['new-password'];
if(isset($_POST['otp']) and isset($newPassword)){
    try{
        $password = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET password=:password WHERE otp=:otp");
        $stmt->execute(['password'=>$password,'otp'=>$otp]);
        $otpResponse = 'password changed';
        header('location: login.php');
    }
    catch(PDOException $e){
        $otpResponse = 'There is no corresponding account to this email';
    }
}
?>