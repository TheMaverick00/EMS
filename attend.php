<?php session_start();?>
<?php include 'include/header.php'?>
<?php include 'include/connection.php';?>

<?php
// starting a session
$ID  = $_SESSION["ID"];
$sql = mysqli_query($conn, "SELECT * FROM employee where ID='$ID' ");
$row = mysqli_fetch_array($sql);
if (is_array($row)) {
    $_SESSION["ID"]    = $row['id'];
    $_SESSION["name"]  = $row['name'];
    $_SESSION["empID"] = $row['empID'];
}
?>


<?php

// $time_in = date('h a');
// $date    = date('y-m-d');
// $emp_id  = $_SESSION["empID"];
$msg = " ";

$time_in = date('H a');
$date    = date('y-m-d');
$empID   = $_SESSION["empID"];

$rtr    = mysqli_query($conn, "SELECT * FROM attendance where date='$date'");
$rowrtr = mysqli_fetch_array($rtr);

if (is_array($rowrtr)) {
    $msg = "You have already check in and out for Today!";
    //header("Location:attendance.php");
} 
if (isset($_POST['punch_in'])) {
        extract($_POST);

        //$sql = "INSERT INTO attendance(emp_id,time_in,date) VALUES('$empID','$time_in','$date') ";
        $sqli = "INSERT INTO `attendance`(`emp_id`, `time_in`, `date`) VALUES ('$empID','$time_in','$date') ";

        if (mysqli_query($conn, $sqli)) {
            header("Location:attendance.php");
        } else {
            echo "Error: " . $sqli . " " . mysqli_error($conn);
        }
    }






?>
<?php include 'include/nav.php'?>
<?php include 'include/empnav.php'?>






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
									<li class="breadcrumb-item active">Attendance </li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					<?php
					// $fetch    = "SELECT * FROM attendance where emp_id = $emp_id AND date = $date";
$result = mysqli_query($conn, "SELECT * FROM attendance where emp_id = '$empID' AND date = '$date' ");
$res    = mysqli_fetch_array($result);

if ($res['time_in'] == '' && $res['time_out'] == '') {?>
			<div class="row">
						<div class="col-md-4">
							<div class="card punch-status">
								<div class="card-body">
									<h5 class="card-title">Timesheet <small class="text-muted">11 Mar 2019</small></h5>
									<?php echo $msg.'' .  $date?>
									<div class="punch-det">
										<h6>Punch In at</h6>
										<p>Wed, 11th Mar 2019 10.00 AM</p>
										<p><?php echo date('l') . ', ' . date('d') . ', ' . date('M') . ', ' . date('Y') . ' ' . date('h:i a') ?> </p>
									</div>
									<div class="punch-info">
										<div class="punch-hours">
											<span>3.45 hrs</span>
										</div>
									</div>
								<form method="POST">
									<input name="time_in" value="<?php echo $time_in ?>" hidden>
									<input name="date" value="<?php echo $date ?>" hidden>
									<!-- <input name="empID" value="<?php //echo $empID ?>" hidden> -->
									<div class="punch-btn-section">
										<button type="submit" class="btn btn-primary punch-btn" name="punch_in">Punch in</button>
									</div>
						      	</form>
							
								</div>
							</div>
						</div>

					
						<?php	} else if($res['time_in'] != NULL && $res['time_out'] ==NULL){?>
					

                       <?php $am = $res['time_in']; ?>
							<div class="row">
						<div class="col-md-4">
							<div class="card punch-status">
								<div class="card-body">
									<h5 class="card-title">Timesheet <small class="text-muted">11 Mar 2019</small></h5>
									<div class="punch-det">
										<h6>Punch In at</h6>
										<p>Wed, 11th Mar 2019 <?php echo $am ?></p>
										<p><?php echo date('l') . ', ' . date('d') . ', ' . date('M') . ', ' . date('Y') . ' ' . date('h:i a') ?> </p>
									</div>
									<div class="punch-info">
										<div class="punch-hours">
											<span>3.45 hrs</span>
										</div>
									</div>
								<form method="POST" action="task/time_out.php">
									<input name="time_in" value="<?php echo $time_in ?>" hidden>
									<input name="date" value="<?php echo $date ?>" hidden>
									<input name="empID" value="<?php echo $empID ?>" hidden>
									<div class="punch-btn-section">
										<button type="submit" class="btn btn-primary punch-btn" name="punch">Punch Out</button>
									</div>
						      	</form>
									<!-- <div class="statistics">
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
									</div> -->
								</div>
							</div>
						</div>





					<?php
} else{?>
<?php $am = $res['time_in']; ?>
   	<div class="row">
						<div class="col-md-4">
							<div class="card punch-status">
								<div class="card-body">
									<h5 class="card-title">Timesheet <small class="text-muted"><?php echo date('d').' '.date('M').' '.date('Y') ?></small></h5>
									<div class="punch-det">
										<h6>Punch In at</h6>
										<p><?php echo date('l') .' '. $res['time_in'] .' '. date('Y') ?></p>
										<h6>Punch Out at</h6>
										<p><?php echo date('l') .' '. $res['time_out'] .' '. date('Y') ?></p>
										<?php 
										
										$s = $res['time_in'];
										$dt = new DateTime($s);
										
										$date = $dt->format('d-m-Y');
										$time = $dt->format('h');
										
										echo $time;
										
										?>
									</div>
									<div class="punch-info">
										<div class="punch-hours">
											<span>3.45 hrs</span>
										</div>
									</div>
								<form method="POST" action="task/time_out.php">
									<input name="time_in" value="<?php echo $time_in ?>" hidden>
									<input name="date" value="<?php echo $date ?>" hidden>
									<input name="empID" value="<?php echo $empID ?>" hidden>
							
						      	</form>
							   <p class="text-center"><?php echo $msg ?></p>
								</div>
							</div>
						</div>



<?php 
}

?>



						<div class="col-md-4">
							<div class="card att-statistics">
								<div class="card-body">
									<h5 class="card-title">Statistics</h5>
									<div class="stats-list">
										<div class="stats-info">
											<p>Today <strong>3.45 <small>/ 8 hrs</small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-primary" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="stats-info">
											<p>This Week <strong>28 <small>/ 40 hrs</small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-warning" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="stats-info">
											<p>This Month <strong>90 <small>/ 160 hrs</small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="stats-info">
											<p>Remaining <strong>90 <small>/ 160 hrs</small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-danger" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="stats-info">
											<p>Overtime <strong>4</strong></p>
											<div class="progress">
												<div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
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
												10.00 AM.
											</p>
										</li>
										<li>
											<p class="mb-0">Punch Out at</p>
											<p class="res-activity-time">
												<i class="fa fa-clock-o"></i>
												11.00 AM.
											</p>
										</li>
										<li>
											<p class="mb-0">Punch In at</p>
											<p class="res-activity-time">
												<i class="fa fa-clock-o"></i>
												11.15 AM.
											</p>
										</li>
										<li>
											<p class="mb-0">Punch Out at</p>
											<p class="res-activity-time">
												<i class="fa fa-clock-o"></i>
												1.30 PM.
											</p>
										</li>
										<li>
											<p class="mb-0">Punch In at</p>
											<p class="res-activity-time">
												<i class="fa fa-clock-o"></i>
												2.00 PM.
											</p>
										</li>
										<li>
											<p class="mb-0">Punch Out at</p>
											<p class="res-activity-time">
												<i class="fa fa-clock-o"></i>
												7.30 PM.
											</p>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>

					<!-- Search Filter -->
					<div class="row filter-row">
						<div class="col-sm-3">
							<div class="form-group form-focus">
								<div class="cal-icon">
									<input type="text" class="form-control floating datetimepicker">
								</div>
								<label class="focus-label">Date</label>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group form-focus select-focus">
								<select class="select floating">
									<option>-</option>
									<option>Jan</option>
									<option>Feb</option>
									<option>Mar</option>
									<option>Apr</option>
									<option>May</option>
									<option>Jun</option>
									<option>Jul</option>
									<option>Aug</option>
									<option>Sep</option>
									<option>Oct</option>
									<option>Nov</option>
									<option>Dec</option>
								</select>
								<label class="focus-label">Select Month</label>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group form-focus select-focus">
								<select class="select floating">
									<option>-</option>
									<option>2019</option>
									<option>2018</option>
									<option>2017</option>
									<option>2016</option>
									<option>2015</option>
								</select>
								<label class="focus-label">Select Year</label>
							</div>
						</div>
						<div class="col-sm-3">
							<a href="#" class="btn btn-success btn-block"> Search </a>
						</div>
                    </div>
					<!-- /Search Filter -->

                    <div class="row">
                        <div class="col-lg-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0">
									<thead>
										<tr>
											<th>#</th>
											<th>Date </th>
											<th>Punch In</th>
											<th>Punch Out</th>
											<th>Production</th>
											<th>Break</th>
											<th>Overtime</th>
										</tr>
									</thead>
									<tbody>
										<?php  
										     $myId = $_SESSION["empID"] ;
									         $attend = mysqli_query($conn,"SELECT * FROM attendance WHERE emp_id= '$myId' ");
											 $i=1;
											
											 while($myrow = mysqli_fetch_array($attend)) {?>
										?>
										<tr>
											<td><?php echo $i++ ?></td>
											<td><?php echo $myrow['date'] ?></td>
											<td> <?php echo $myrow['time_in'] ?></td>
											<td><?php echo $myrow['time_out'] ?></td>
											<td>9 hrs</td>
											<td>1 hrs</td>
											<td>0</td>
										</tr>

										<?php }?>
									
									</tbody>
								</table>
							</div>
                        </div>
                    </div>
                </div>
				<!-- /Page Content -->

            </div>
			<!-- Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->
        <?php include 'include/footer.php'?>