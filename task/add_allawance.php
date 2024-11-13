<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                           
                         
                               $name = $_POST['name'];
                               $amount = $_POST['amount'];
                               $category = $_POST['category'];
                               $level = $_POST['level'];
                              
                            $sql =   "INSERT INTO allawance(name,category,amount,level) VALUES ('$name','$category','$amount','$level')";

                             //$sql = "INSERT INTO assets (name, assetID, purchase_date, amount, condition, manufacturer, sn, supplier, user, status) VALUES('$name','$assetID','$purchase_date','$amount','$condition','$manufacturer','$sn','$supplier','$user','$status') ";
                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../allawance.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>