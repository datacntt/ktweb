
<style>
*{
  font-size: 30px;
}

</style>
<?php 
session_start();
if(!isset($_SESSION['us'])){
  $_SESSION['us']="";
}

?>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "kt";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

if (isset($_POST['submit'])) {

  $email = $_POST['email'];
  $password = md5($_POST['matkhau']);


  $sql = "SELECT email,matkhau FROM tai_khoang where email = '$email' and matkhau = '$password' ";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
   echo "alert('thanh cong');";

   $_SESSION['us']=$email;
    header('Location: them.php ');
  }
}
?>


<form action="" method="POST">

  <label for="">Email</label>

  <input type="text" name="email">

  <label for="">Mat Khau</label>

  <input type="text" name="matkhau">

  <input type="submit" name="submit" value="ĐĂNG NHẬP">
</form>