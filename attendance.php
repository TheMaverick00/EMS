<?php include('include/header.php') ?>
<?php 
include('include/connection.php');

include('class.php');

$object = new major;


?>
<?php
function display_msg($message) {
    // Display message
    echo "<script>alert('$message');</script>";
}

$msg = "";
if(isset($_POST['submit']))
{
    extract($_POST);
    
   
	$name = $_POST['name'];
	$email = $_POST['email'];
	$empId = $_POST['empId'];
	$joiningDate = $_POST['joiningDate'];
	$phone = $_POST['phone'];
	$department = $_POST['department'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];  

	//$sql =   "INSERT INTO assets( `name`, `email`, `purchase_date`, `amount`, `condition`, `manufacturer`, `sn`, `supplier`, `user`, `status`) VALUES ('$name','$assetID','$purchase_date','$amount','$condition','$manufacturer','$sn','$supplier','$user','$status')";

    $sql=mysqli_query($conn,"SELECT * FROM employee where email='$email'");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {
        $msg = "Email Already registered";
     
    }else if($password != $cpassword){
        $msg = "password does not match";
    }
    else
    {
        $encPass = md5($pass);
		$sql = "INSERT INTO employee( `name`, `email`, `empID`, `joiningDate`, `phone`, `department`, `password`) VALUES ('$name','$email','$empId','$joiningDate','$phone','$department','$password')";
        if(mysqli_query($conn,$sql)){
            display_msg("Registeration successful");
            header("Location: login.php");  
        }
    }
}


?>

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
<?php
include('./include/nav.php');
include('./include/sidenav.php');
?>

        
        <!-- Page Wrapper -->
        <div class="page-wrapper">

            <!-- Page Content -->
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Today's Attendance</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Staff</li>
                            </ul>
                        </div>
                     
                    </div>
                </div>
                <!-- /Page Header -->


                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table datatable">
                                <thead>
                                    <tr>
                                    <th>Date </th>
                                    <th>Employee Name</th>
                                <th>Punch In</th>
                                <th>Punch Out</th>
                                <th>Time Spent Before Pumch Out</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php 
                                            $today = $object->today;
                                   $object->query="
                                   SELECT * FROM attendance WHERE  (date LIKE '$today%')
                                   ";
                                   $object->execute();
                                   $row = $object->get_result();
                                   foreach($row as $res){
                                       ?>


                                    <tr>
                                    <td><?php echo $res['date']?></td>
                                    <td><?php echo $object->get_employee_name($res['emp_id'])?></td>

                                <td><?php echo $res['time_in']?></td>
                                <td><?php echo $res['time_out']?></td>
                                <td><?php echo $res['time_spend']?></td>
                                    </tr>

                    



                                    <?php } ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->


          

        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Slimscroll JS -->
    <script src="assets/js/jquery.slimscroll.min.js"></script>

    <!-- Select2 JS -->
    <script src="assets/js/select2.min.js"></script>

    <!-- Datetimepicker JS -->
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Datatable JS -->
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>

    <!-- Custom JS -->
    <script src="assets/js/app.js"></script>

</body>

</html>