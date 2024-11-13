<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                           
                           $id = $_POST['id'];
                           
                           $resp = $_POST['responsibility'];
                           $emp_id = $_POST['emp_id'];
                           $level = $_POST['level'];


                           $sql = "UPDATE `approval_list` SET responsibility='$resp',emp_id = '$emp_id',level='$level',level='$level' WHERE id='$id' ";



                      
                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../approval.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>