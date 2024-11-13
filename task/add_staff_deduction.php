<?php 
include('../class.php');
$object = new major;

?>
<?php include '../include/connection.php';?>
<?php 
                           
                         
                               $emp_id = $_POST['emp_id'];
                               $deduction = $_POST['deduction_id'];
                               $month = date('m');
                               $amount = $object->get_deduction_amount($deduction);
                               $sql = "INSERT INTO deductions(emp_id,deduction_id,amount,month) VALUES('$emp_id','$deduction','$amount','$month') ";
                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../allawance.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>