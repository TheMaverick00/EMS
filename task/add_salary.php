<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                           
                         
                               $empID = $_POST['empID'];
                               $level = $_POST['level'];
                               $basic = $_POST['basic'];
                               $hra = $_POST['hra'];
                               $loan = $_POST['loan'];
                               $salary = $_POST['salary'];

                               $sql = "INSERT INTO `salary`(`empID`, `level`, `basic`, `hra`, `loan`, `salary`) VALUES ('$empID','$level','$basic','$hra','$loan','$salary')";
                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../salary.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>