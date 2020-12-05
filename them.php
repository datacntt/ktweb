
<?php 
session_start();
if($_SESSION['us']==""){
    header('Location: login.php ');
}

?>
<style>
*{
  font-size: 30px;
}

</style>


<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "kt";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
$th = "select * from thuong_hieu  ";

$thuong_hieu = $conn->query($th);

$xe = "select * from xe ";
$tx = $conn->query($xe);
$dem = 0;
$kq = $tx->num_rows;

/* while($row = $tx ->fetch_assoc()) {
    $dem++;
  }

*/
?>

<?php

echo "THEM XE MO";
echo "( hien co " . $kq . " xe )";

?>

<?php
$st1 = '';
if (isset($_POST['them'])) {
    if ($_FILES['anh']['error']) {
        echo "alert('Loi up load')";
    } else {
        move_uploaded_file($_FILES['anh']['tmp_name'], 'upload/' . $_FILES['anh']['name']);
        echo "<script>alert('Up load thanh cong')</script>";
        $st1 = 'upload/' . $_FILES['anh']['name'];
    }

    $tx1 = $_POST["tx"];
    $nb1 = $_POST["nb"];
    $gia1 = $_POST["gia"];
    $thieu1 = $_POST["thuonghieu"];

    $them_data = "INSERT INTO `xe` (`ten_xe`, `ngay_khoi_ban`,`gia`,`anh`, `id_thuong_hieu`) VALUES ('$tx1','$nb1','$gia1','$st1','$thieu1')";
    
    if ($conn->query($them_data) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $them_data . "<br>" . $conn->error;
      }
      
}



?>

<form action="" method="post" enctype="multipart/form-data">

    <label for="">ten xe</label>
    <input type="text" name="tx" id="">
    <br>
    <label for="">ngay ban</label>
    <input type="date" name="nb" id="" value="<?php echo date('Y-m-d'); ?>">
    <br>
    <label for="">gia</label>
    <input type="number" name="gia" id="" min="" max="" value="0">
    <br>
    <label for="">chon anh</label>
    <input type="file" name="anh" id="">
    <br>

    <label for="">thuong hieu</label>
    <select name="thuonghieu">

        <?php while ($row = $thuong_hieu->fetch_assoc()) {  ?>

            <option value="<?php echo $row['id_thuong_hieu'] ?>"><?php echo $row['ten_thuong_hieu'] ?></option>

        <?php } ?>

    </select>


    <input type="submit" value="Them" name="them">

</form>