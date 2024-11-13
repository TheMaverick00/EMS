<?php
ob_start();
include('class.php');

$object = new major;

$today_date = $object->today;


$now = $object->now;
$attendance_today =$object->check_today_attedance();
$emp_id = $_SESSION['ID'];
$now_in_ts = $object->now_in_ts;
$month = date('m');
if($attendance_today == 0){
	// logic to mark attendance
	$object->query="
      INSERT INTO attendance(emp_id,time_in,time_out,time_spend,date,month)
	  VALUES('$emp_id','$now','NULL','0','$now_in_ts','$month')	
	";
	$object->execute();

	$punch_in = "NOW";
	$duration = "0 second";
}else{
	// logic when attendance  has been marked
	$punch_in = strtotime($object->get_punch_in_time());
	
	$duration = $object->GetTimeDiff($punch_in);

}

?>
<?php include('include/header.php') ?>
<?php include 'include/connection.php';?>
<?php include('include/empnavbar.php') ?>
<?php include('include/empnav.php') ?>


<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Attendance</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-4">
                <div class="card punch-status">
                    <div class="card-body">
                        <h5 class="card-title">Timesheet <small class="text-muted"><?php echo $today_date?></small></h5>
                        <div class="punch-det">
                            <h6>Punch In at</h6>
                            <p><?php echo $object->get_time_in() ?></p>
                        </div>
                        <div class="punch-info">
                            <div class="punch-hours">
                                <?php
                                   $punch_out =  $object->get_punch_out_status();
                                   if($punch_out==0){
                                ?>
                                <span><?php
                                                                echo $duration;

                                   }else{
                                     echo  "<span style='color:red'>Punched out.</span>";
                                   }
                                
                                ?></span>
                            </div>
                        </div>
                        <div class="punch-btn-section">
                            <button type="button" class="btn btn-primary punch-btn" data-toggle="modal"
                                data-target="#punch_out">Punch
                                Out</button>
                        </div>
                        <div class="statistics">
                            <div class="row">
                                <div class="col-md-6 col-6 text-center">
                                    <div class="stats-box">
                                        <p>Break</p>
                                        <h6>1.21 hrs</h6>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6 text-center">
                                    <div class="stats-box">
                                        <p>Overtime</p>
                                        <h6>3 hrs</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card att-statistics">
                    <div class="card-body">
                        <h5 class="card-title">Statistics</h5>
                        <div class="stats-list">
                            <div class="stats-info">
                                <p>Today <strong><?php echo $duration ?> <small>out of
                                            <?php echo $object->get_today_task_duration() ?></small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 31%"
                                        aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!-- <div class="stats-info">
                                <a href="#" class="btn btn-success punch-btn" data-toggle="modal"
                                    data-target="#add_asset"><i class="fa fa-plus"></i> Take Break</a>
                            </div> -->

                            <!-- <div class="stats-info">
                                <a href="#"><button type="button" class="btn btn-primary punch-btn">Take
                                        Overtime</button></a>
                            </div> -->
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card recent-activity">
                    <div class="card-body">
                        <h5 class="card-title">Today Activity</h5>
                        <ul class="res-activity-list">
                            <li>
                                <p class="mb-0">Punch In at</p>
                                <p class="res-activity-time">
                                    <i class="fa fa-clock-o"></i>
                                    <?php echo $object->get_time_in() ?>
                                </p>
                            </li>

                            <li>
                                <p class="mb-0">Task for today</p>
                                <p class="res-activity-time">
                                    <i class="fa fa-"></i>
                                    <b><?php echo $object->get_today_task() ?></b>
                                </p>
                                <p class="res-activity-time">
                                    <i class="fa fa-clock-o"></i>
                                    <?php echo $object->get_today_task_duration()?> hours
                                </p>
                            </li>
                            <h5 style="text-decoration:underline">Uncompleted task</h5>
                            <?php
                                            $object->query="
											SELECT * FROM task WHERE complete_status = '0' AND assigned_to='$_SESSION[ID]'
											";
											$object->execute();
											$count = $object->row_count();
											if($count != 0){
											$row = $object->get_result();
											foreach($row as $res){
										?>
                            <li>
                                <p class="res-activity-time">
                                    <?php echo $res['task_title']?>
                                </p>
                                <p class="res-activity-time">
                                    Assigned by: <?php echo $object->get_employee_name($res['assigned_by'])?>
                                </p>
                            </li>
                            <?php
											}
											}else{
												?>

                            <li>
                                <p class="mb-0">Punch In at</p>
                                <p class="res-activity-time">
                                    <b>No uncompeleted task</b>
                                </p>
                            </li>
                            <?php
											}
										?>


                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <!-- Search Filter -->
         
        <h3 class="text-center mt-3 mb-5">Attendance Record</h3>

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0">
                        <thead>
                            <tr>
                                <th>Date </th>
                                <th>Punch In</th>
                                <th>Punch Out</th>
                                <th>Time Spent Before Punch Out</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                           $object->query="
										   SELECT * FROM attendance WHERE emp_id='$_SESSION[ID]'
										   ";
										   $object->execute();
										   $row = $object->get_result();
										   foreach($row as $res){
										   

                                        ?>
                            <tr>
                                <td><?php echo $res['date']?></td>
                                <td><?php echo $res['time_in']?></td>
                                <td><?php echo $res['time_out']?></td>
                                <td><?php echo $res['time_spend']?></td>

                            </tr>
                            <?php
										   }
										?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Delete Asset Modal -->
    <div class="modal custom-modal fade" id="punch_out" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Punch Out </h3>
                        <p>Are you sure want to punch out?</p>
                    </div>
                    <div class="modal-btn punch_out-action">
                        <div class="row">
                            <div class="col-6">
                                <!-- <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a> -->
                                <a href="punch_out.php" class="btn btn-primary continue-btn col-md-12">Punch Out</a>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-dismiss="modal"
                                    class="btn btn-primary cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Asset Modal -->
    <!-- Add Asset Modal -->

    <div id="add_asset" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Take Break</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="task/add_asset.php">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Asset Name</label>
                                    <input class="form-control" type="text" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Asset Id</label>
                                    <input class="form-control" type="text" name="assetID"
                                        value="<?php echo "AST"."-".rand(10,10000)."-FGN" ?>">
                                </div>
                            </div>
                        </div>
                       
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" name="add">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Asset Modal -->



</div>
<!-- Page Wrapper -->

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

<!-- Custom JS -->
<script src="assets/js/app.js"></script>

</body>

</html>