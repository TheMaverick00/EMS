<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                           
                           $id = $_POST['id'];
                           $name = $_POST['name'];
                        $amount = $_POST['amount'];


                           $sql = "UPDATE `deduction_list` SET deduction_name='$name',amount = '$amount'  WHERE id='$id' ";



                      
                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../allawance.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>