<?php 
include('class.php');
include('include/header.php');
$object = new major;
?>
<?php include 'include/connection.php';?>
<?php include('include/empnav.php') ?>
<?php include('include/empnavbar.php') ?>
			
			<!-- Page Wrapper -->
			<?php 
                       $id = $_SESSION['ID'];
                       $pro = mysqli_query($conn,"SELECT * FROM  employee WHERE id = '$id'");
					   $row = mysqli_fetch_array($pro);
					   
                     ?>
					 <?php


if(isset($_POST['submit']))
{	 

    
	 
    $file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $folder="pictures/";
    $new_file_name = strtolower($file);
    $final_file=str_replace(' ','-',$new_file_name);
    
  
        if(move_uploaded_file($file_loc,$folder.$final_file)){
        $edit = "UPDATE employee SET picture='".$file."' WHERE id='".$id."'";
        mysqli_query($conn,$edit)or die("Could Not Perform Update");
        echo "<script>Profile Updated</script>";
        header ("Location: profile.php");
        }
 
    }


?>
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Profile</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Profile</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="card mb-0">
						<div class="card-body p-5">
							<div class="row">
								<div class="col-md-12">
									<div class="profile-view">
									<div class="profile-img-wrap">
											<?php 
											    if($row['picture']==""){
													?>
														<div class="profile-img">
												<a href="#"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
											</div>
											<?php
											      
												}else{
													?>
														<div class="profile-img">
												<a href="#"><img alt="" src="pictures/<?php echo $row['picture'] ?>"></a>
											</div>

											<?php	}
											?>
										
											
										</div>
										<div class="profile-basic">
											<div class="row">
												<div class="col-md-5">
													<div class="profile-info-left">
														<h3 class="user-name m-t-0 mb-0"><?php echo $object->get_employee_name($_SESSION['ID']) ?></h3>
														<h6 class="text-muted"><?php echo $object->get_employee_dept($_SESSION['ID']) ?></h6>
														<div class="staff-id">Employee ID : <?php echo $object->get_employee_id($_SESSION['ID'])?> </div>
														<div class="small doj text-muted">Date of Join : <?php echo $object->get_employee_join_date($_SESSION['ID']) ?></div>
														<div class="mt-3">
														<form enctype="multipart/form-data" method="POST">
											<input type="file" name="file"  id="name" value="<?php //echo $old_photo ?>" placeholder="Edit">
											<div class="text-left"><button type="submit" name="submit" class="btn btn-primary mt-3">Upload Picture</button></div>
										</form>
														</div>
													</div>
												</div>
												<div class="col-md-7">
													<ul class="personal-info">
														<li>
															<div class="title">Phone:</div>
															<div class="text"><a href="tel:<?php echo $object->get_employee_phone($_SESSION['ID'])?>"><?php echo $object->get_employee_phone($_SESSION['ID']) ?></a></div>
														</li>
														<li>
															<div class="title">Email:</div>
															<div class="text"><a href="mailto:<?php echo $object->get_employee_email($_SESSION['ID'])?>"><?php echo $object->get_employee_email($_SESSION['ID'])?></a></div>
														</li>
														
													
													
													</ul>
												</div>
											</div>
										</div>
										<!-- <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div> -->
									</div>
								</div>
							</div>
						</div>
					</div>
					

				
                </div>
				<!-- /Page Content -->

				
				<!-- Experience Modal -->
				<div id="experience_info" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Experience Informations</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="form-scroll">
										<div class="card">
											<div class="card-body">
												<h3 class="card-title">Experience Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="Digital Devlopment Inc">
															<label class="focus-label">Company Name</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="United States">
															<label class="focus-label">Location</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="Web Developer">
															<label class="focus-label">Job Position</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<div class="cal-icon">
																<input type="text" class="form-control floating datetimepicker" value="01/07/2007">
															</div>
															<label class="focus-label">Period From</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<div class="cal-icon">
																<input type="text" class="form-control floating datetimepicker" value="08/06/2018">
															</div>
															<label class="focus-label">Period To</label>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="card">
											<div class="card-body">
												<h3 class="card-title">Experience Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="Digital Devlopment Inc">
															<label class="focus-label">Company Name</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="United States">
															<label class="focus-label">Location</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="Web Developer">
															<label class="focus-label">Job Position</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<div class="cal-icon">
																<input type="text" class="form-control floating datetimepicker" value="01/07/2007">
															</div>
															<label class="focus-label">Period From</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<div class="cal-icon">
																<input type="text" class="form-control floating datetimepicker" value="08/06/2018">
															</div>
															<label class="focus-label">Period To</label>
														</div>
													</div>
												</div>
												<div class="add-more">
													<a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
												</div>
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Experience Modal -->
				
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
		
		<!-- Tagsinput JS -->
		<script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		
    </body>
</html>