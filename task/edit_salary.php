<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                           $id = $_POST['id'];
                           $empID = $_POST['empID'];
                           $level = $_POST['level'];
                           $basic = $_POST['basic'];
                           $hra = $_POST['hra'];
                           $loan = $_POST['loan'];
                           $salary = $_POST['salary'];
                          // $sql ="UPDATE salary SET id='$id',empID='$empID',level='$level',basic='$basic',hra='$hra',loan='$loan',salary='$salary'  WHERE id=' $id'";

                     $sql =  " UPDATE salary SET `id`='$id',`empID`='$empID',`level`='$level',`basic`='$basic',`hra`='$hra',`loan`='$loan',`salary`='$salary' WHERE empID='$empID'";


                      
                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../salary.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>