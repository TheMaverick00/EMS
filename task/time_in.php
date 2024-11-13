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

$time_in = date('h a');
$date    = date('y-m-d');
$empID   = $_SESSION["empID"];

$rtr=mysqli_query($conn,"SELECT * FROM attendance where date='$date'");
$rowrtr  = mysqli_fetch_array($rtr);

if(is_array($row))
{
    $msg = "You have already check in for Today!";
    header("Location: ../attendance.php");
 
}else{
    if (isset($_POST['punch'])) {
        extract($_POST);
    
        //$sql = "INSERT INTO attendance(emp_id,time_in,date) VALUES('$empID','$time_in','$date') ";
        $sqli = "INSERT INTO `attendance`(`emp_id`, `time_in`, `date`) VALUES ('$empID','$time_in','$date') ";
        
        if (mysqli_query($conn, $sqli)) {
            header("Location: ../attendance.php");
        } else {
            echo "Error: " . $sqli . " " . mysqli_error($conn);
        }
    }
    
}



?>