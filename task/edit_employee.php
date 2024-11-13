<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                           
                           $id = $_POST['id'];
                           $name = $_POST['name'];
                           $empID = $_POST['empId'];
                           $email = $_POST['email'];                   
                           $department = $_POST['department'];
                           $phone = $_POST['phone'];                   
                           $joiningDate = $_POST['joiningDate'];
                           $password = $_POST['password'];


                         //  $sql = "UPDATE `assets` SET `id`='$id',`name`='$name',`assetID`='$assetID',`purchase_date`='$purchase_date',`amount`='$amount',`condition`='$condition',`manufacturer`='$manufacturer',`sn`='$sn',`supplier`='$supplier',`user`='$user',`status`='$status' WHERE id='$id'";
                           $sql = "UPDATE `employee` SET `id`='$id',`name`='$name',`email`='$email',`empID`='$empID',`joiningDate`='$joiningDate',`phone`='$phone',`department`='$department',`password`='$password'  WHERE id='$id' ";



                      
                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../employees.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>