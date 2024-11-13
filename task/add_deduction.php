<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                           
                         
                               $amount = $_POST['amount'];
                               $name = $_POST['name'];
                               $sql = "INSERT INTO deduction_list(deduction_name,amount) VALUES('$name','$amount') ";
                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../allawance.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>