
 <?php

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
<?php 
//    session_start();
  if(!isset($_SESSION['ID']) || !isset($_SESSION['Email']) )      // if there is no valid session
{
    header("Location: login");
}

?>

<?php include('include/header.php') ?>

<?php include 'include/connection.php';?>

<?php
				 // starting a session
				$ID= $_SESSION["ID"];
				$sql=mysqli_query($conn,"SELECT * FROM employee where ID='$ID' ");
				$row  = mysqli_fetch_array($sql);
                if(is_array($row)) {
                    $_SESSION["ID"] = $row['id'];
                   $_SESSION["name"]=$row['name'];
               }
 ?>


<!--End of header-->
<?php include('include/nav.php') ?>
<?php include('include/sidenav.php') ?>

<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Welcome <?php echo $_SESSION["name"]; ?>,</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body b-1">
                        <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                        <div class="dash-widget-info">
                       
                            <span><a href="employees" class="text-dark">Staff  Management</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body b-1">
                        <span class="dash-widget-icon"><i class="fa fa-building-o"></i></span>
                        <div class="dash-widget-info">

                            <span><a href="department" class="text-dark">Department Management</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body b-1">
                        <span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>
                        <div class="dash-widget-info">
                            <span><a href="asset" class="text-dark">Asset Management</a></span>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body b-1">
                        <span class="dash-widget-icon"><i class="fa fa-clock-o"></i></span>
                        <div class="dash-widget-info">
                            <span><a href="adminattendance" class="text-dark">My Attendance</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body b-1">
                        <span class="dash-widget-icon"><i class="fa fa-bank"></i></span>
                        <div class="dash-widget-info">
                            <span><a href="salary" class="text-dark">Salary Management</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Second Row admin functionality-->

        <div class="row">
        
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body b-1">
                        <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                        <div class="dash-widget-info">
                            <span><a href="users" class="text-dark">Role Management</a></span>
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body b-1">
                        <span class="dash-widget-icon"><i class="fa fa-check-square"></i></span>
                        <div class="dash-widget-info">
                            <span><a href="attendance" class="text-dark">View Staff Attendance</a></span>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card punch-status">
                    <div class="card-body b-1">
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
                    <div class="card-body b-1">
                        <h5 class="card-title">Statistics</h5>
                        <div class="stats-list">
                            <div class="stats-info">
                                <p>Today <strong><?php echo $duration ?> <small>out of
                                            <?php echo 11 . " hours" ?></small></strong></p>
                             
                            </div>
                            <!-- <div class="stats-info">
                                $object->get_today_task_duration()
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
                    <div class="card-body b-1">
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
   
    <!-- PUNCH OUT Modal -->
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
    <!-- /PUNCH OUT -->

    </div>
</div>
    <!-- /Page Wrapper -->



<?php include('include/footer.php') ?>