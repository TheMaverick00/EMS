<?php include('../class.php');
$object = new major;

?>
<?php include '../include/connection.php';?>
<?php 
                           
                         
                               $name = $_POST['task'];
                               $duration = $_POST['duration'];
                               $emp_id = $_POST['employee'];
                               $assigned_by = $_SESSION['ID'];
                               $complete_status = 0;
                               $date = $object->today;

                               $sql = "INSERT INTO task(task_title,assigned_by,assigned_to,duration,complete_status,date) VALUES('$name','$assigned_by','$emp_id','$duration','$complete_status','$date') ";

                               if (mysqli_query($conn, $sql)) {
                                        header("Location: ../daily_task.php"); 
                                } else {
                                   echo "Error: " . $sql . " " . mysqli_error($conn);
                                }
                           
 ?>