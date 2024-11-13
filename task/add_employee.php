<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                           
                         
                               $name = $_POST['name'];
                               $empId = $_POST['empId'];
                   
                               $email = $_POST['email'];
                               $password = $_POST['password'];
                               $cpassword = $_POST['cpassword'];  
                               $joiningDate = $_POST['joiningDate'];
                               $phone = $_POST['phone'];
                               $department = $_POST['department'];
                               $account = $_POST['account'];
                               $bank = $_POST['bank'];
                            //    $status = $_POST['status'];
                               $encpassword = md5($password);
                               //$sql =   "INSERT INTO assets( `name`, `email`, `purchase_date`, `amount`, `condition`, `manufacturer`, `sn`, `supplier`, `user`, `status`) VALUES ('$name','$assetID','$purchase_date','$amount','$condition','$manufacturer','$sn','$supplier','$user','$status')";
                               $sql = "INSERT INTO employee( `name`, `email`, `empID`, `joiningDate`, `phone`, `department`, `password`, `account`, `bank`) VALUES ('$name','$email','$empId','$joiningDate','$phone','$department','$encpassword','$account','$bank')";

                             //$sql = "INSERT INTO assets (name, assetID, purchase_date, amount, condition, manufacturer, sn, supplier, user, status) VALUES('$name','$assetID','$purchase_date','$amount','$condition','$manufacturer','$sn','$supplier','$user','$status') ";
                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../employees.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>