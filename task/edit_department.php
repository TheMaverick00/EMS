<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                           
                      
                               $depart = $_POST['depart'];
                               $id = $_POST['id'];
                         
                               $sql = "UPDATE department SET `id`='$id',`name`='$depart' WHERE id = '$id' ";
                               if (mysqli_query($conn, $sql)) {
                                       header("Location: ../department.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>