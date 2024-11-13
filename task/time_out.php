<?php session_start();?>
<?php include '../include/connection.php';?>

<?php
// starting a session
$ID  = $_SESSION["ID"];
$sql = mysqli_query($conn, "SELECT * FROM employee where ID='$ID' ");
$row = mysqli_fetch_array($sql);
if (is_array($row)) {
    $_SESSION["ID"]    = $row['id'];
    $_SESSION["name"]  = $row['name'];
    $_SESSION["empID"] = $row['empID'];
}

$result = mysqli_query($conn, "SELECT * FROM attendance");
$res    = mysqli_fetch_array($result);


$time_out = date('h a');
// $id = $res['id'];
$time_in = $res['time_in'];
$emp_id = $res['emp_id'];
$time_spend = 9;
$date = $res['date'];

$update = "UPDATE `attendance` SET `emp_id`='$emp_id',`time_in`='$time_in',`time_out`='$time_out',`time_spend`='$time_spend',`date`='$date' WHERE emp_id='$emp_id'";

$sql = mysqli_query($conn, "SELECT * FROM employee where ID='$ID' ");

if (mysqli_query($conn, $update)) {
    header("Location: ../attendance.php"); 
} else {
echo "Error: " . $update . " " . mysqli_error($conn);
}

?>