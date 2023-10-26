<?php
require_once 'dbconnect.php';
session_start();
if( isset($_POST['signup']) && $_POST["username"] != '' && $_POST["password"] != ''){ // sign up section

  $username = $_POST['username'];
  $sql = "SELECT * FROM Credentials WHERE user_name='$username'";
  $isAvailable = mysqli_query($conn,$sql);

  if (mysqli_num_rows($isAvailable) > 0){

    echo "Username available please try again";

  } else {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password); // encrypted password

    $sql = "INSERT INTO Credentials (user_name, hashed_password) VALUES ('$username', '$password')";
    mysqli_query($conn,$sql);
    echo "Signed up Success";
  }
}

if( isset($_POST['login']) && $_POST["username"] != '' && $_POST["password"] != ''){ // login section
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password = md5($password); // encrypted password

  $sql = "SELECT * FROM Credentials WHERE user_name='$username' AND hashed_password='$password'";
  $Credentials = mysqli_query($conn,$sql);

  if (mysqli_num_rows($Credentials) > 0){ // check if query return 1 row mean username and pw are correct
    $_SESSION["user"] = $username;
    header("location:upload.php");
  } else {
    echo"username or password was wrong";
  }
}
?>


<h2>Login here</h2>
<form action="login.php" method="post">
  <input type="text" name="username" placeholder="username" />
  <br>
  <br>
  <input type="password" name="password" placeholder="password" />
  <br>
  <br>
  <button type="submit" name="login">Login</button>
</form>


<h2>Sign Up Here</h2>
<form action="login.php" method="post">
    <input type="text" name="username" placeholder="username" />
    <br>
    <br>
    <input type="password" name="password" placeholder="password" />
    <br>
    <br>
    <button type="submit" name="signup">Sign Up</button>
</form>
