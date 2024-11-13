<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                           
                         
                               $emp_id = $_POST['emp_id'];
                               $no_of_days = $_POST['no_of_days'];
                               $reason = $_POST['reason'];
                               $leave_type = $_POST['leave_type'];
                              
                            $sql =   "INSERT INTO leaves(emp_id,no_of_days,reason,leave_type) VALUES ('$emp_id','$no_of_days','$reason','$leave_type')";

                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../leaves.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>