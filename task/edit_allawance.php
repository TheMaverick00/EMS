<?php session_start(); ?>
<?php include '../include/connection.php';?>
<?php 
                           
                           $id = $_POST['id'];
                           $name = $_POST['name'];
                        $amount = $_POST['amount'];
                        $category = $_POST['category'];
                        $level = $_POST['level'];


                           $sql = "UPDATE `allawance` SET name='$name',amount = '$amount',category='$category',level='$level' WHERE id='$id' ";



                      
                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../allawance.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>