<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                           
                         
                               $emp_id = $_POST['emp_id'];
                               $resp = $_POST['responsibility'];
                               $level = $_POST['level'];
                               $sql = "INSERT INTO approval_list(emp_id,responsibility,level) VALUES('$emp_id','$resp','$level') ";
                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../approval.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>