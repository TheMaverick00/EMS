<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                           
                         
                               $designation = $_POST['designation'];
                               $emp_id = $_POST['emp_id'];
                               $level = $_POST['level'];
                               $sql = "INSERT INTO designation(designation,emp_id,level) VALUES('$designation','$emp_id','$level') ";
                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../position.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>