<?php
include 'conding.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

    $select = mysqli_query($conn, "SELECT * FROM `user` WHERE email='$email'") or die('query failed');

    if(mysqli_num_rows($select) > 0){
        $message[] = 'User already exists!';
    } else {
        if($pass !== $cpass){
            $message[] = 'Passwords do not match!';
        } else {
            mysqli_query($conn, "INSERT INTO `user`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
            $message[] = 'Registered successfully';
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
    <link rel="stylesheet" href="form.css">
</head>
<body>
    
<?php
if(isset($message)){
    foreach($message as $msg){
        echo '<div class="message" onclick="this.remove();">'.$msg.'</div>';
    }
}
?>

<div class="form-container">
    <form action="" method="post">
        <h3>Registration Here</h3>
        <input type="text" name="name" required placeholder="Enter your username" class="box">
        <input type="email" name="email" required placeholder="Enter your email" class="box">
        <input type="password" name="password" required placeholder="Enter your password" class="box">
        <input type="password" name="cpassword" required placeholder="Confirm your password" class="box">
        <input type="submit" name="submit" class="btn" value="Register Now">
        <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
</div>    

</body>
</html>
