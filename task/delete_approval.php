<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                 
                  
                 
                    $id= $_GET['id'];
                    $sql = "DELETE FROM approval_list WHERE id='" . $id . "'";
                    if (mysqli_query($conn, $sql)) {
                        header("Location: ../approval.php"); 
                    } else {
                        echo "Error deleting record: " . mysqli_error($conn);
                    }
                  
               
 ?>