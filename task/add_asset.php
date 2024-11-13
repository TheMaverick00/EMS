<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                           
                         
                               $name = $_POST['name'];
                               $assetID = $_POST['assetID'];
                               $purchase_date = $_POST['purchase_date'];
                               $amount = $_POST['amount'];
                               $condition = $_POST['condition'];
                               $manufacturer = $_POST['manufacturer'];  
                               $sn = $_POST['sn'];
                               $supplier = $_POST['supplier'];
                               $user = $_POST['user'];
                               $status = $_POST['status'];

                            $sql =   "INSERT INTO assets( `name`, `assetID`, `purchase_date`, `amount`, `condition`, `manufacturer`, `sn`, `supplier`, `user`, `status`) VALUES ('$name','$assetID','$purchase_date','$amount','$condition','$manufacturer','$sn','$supplier','$user','$status')";

                             //$sql = "INSERT INTO assets (name, assetID, purchase_date, amount, condition, manufacturer, sn, supplier, user, status) VALUES('$name','$assetID','$purchase_date','$amount','$condition','$manufacturer','$sn','$supplier','$user','$status') ";
                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../asset.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>