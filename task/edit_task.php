<?php 
include('../class.php');
$object = new major;

?>
<?php include '../include/connection.php';?>
<?php 
                           
                               $duration = $_POST['duration'];
                               $assigned_by = $_SESSION['ID'];
                               $complete_status = $_POST['complete'];
                               $date = $object->today;
                               $id = $_POST['id'];
                               $name = $_POST['name'];

                           $sql = "UPDATE `task` SET `duration`='$duration',`task_title`='$name',`complete_status`='$complete_status'  WHERE id='$id' ";



                      
                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../daily_task.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>