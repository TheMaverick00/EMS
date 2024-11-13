<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                               $isAdmin = 0;                  
                               $id = $_GET['id'];
                               
                               $sql = "UPDATE employee SET `id`='$id',`isAdmin`='$isAdmin' WHERE id = '$id' ";
                               if (mysqli_query($conn, $sql)) {
                                       header("Location: ../users.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>