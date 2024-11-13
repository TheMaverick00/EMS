<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                           
                         
                               $depart = $_POST['depart'];
                               $sql = "INSERT INTO department(name) VALUES('$depart') ";
                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../department.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>