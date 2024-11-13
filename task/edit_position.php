<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                           
                           $id = $_POST['id'];
                           
                           $designation = $_POST['designation'];
                           $emp_id = $_POST['emp_id'];
                           $level = $_POST['level'];


                           $sql = "UPDATE `designation` SET designation='$designation',emp_id = '$emp_id',level='$level',level='$level' WHERE id='$id' ";



                      
                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../position.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>