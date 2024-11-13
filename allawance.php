<?php 
include('class.php');
include('include/header.php');
$object = new major;
?>
<?php include 'include/connection.php';?>
<?php include('include/nav.php') ?>
<?php include('include/sidenav.php') ?>

<style>
select {
    padding: 13px;
    width: 100%;
    border-color: #dee2e6;
}
</style>

<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Allowance and Deductions</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Payroll Items</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Page Tab -->
        <div class="page-menu">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab_additions">Allowance</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab_deductions">Deductions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Tab -->

        <!-- Tab Content -->
        <div class="tab-content">

            <!-- Additions Tab -->
            <div class="tab-pane show active" id="tab_additions">

                <!-- Add Addition Button -->
                <div class="text-right mb-4 clearfix">
                    <button class="btn btn-primary add-btn" type="button" data-toggle="modal"
                        data-target="#add_addition"><i class="fa fa-plus"></i> Add Allowance</button>
                </div>
                <!-- /Add Addition Button -->

                <!-- Payroll Additions Table -->
                <div class="payroll-table card">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Default/Unit Amount</th>
									<th>Level</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$object->query="
SELECT * FROM allawance
";
$object->execute();
$res = $object->get_result();
foreach($res as $row){
?>
                                <tr>
                                    <th><?php echo $row['name'] ?></th>
                                    <td><?php echo $row['category'] ?></td>
                                    <td>£<?php echo $row['amount'] ?></td>
									<td><?php echo $row['level'] ?></td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <?php
 if(isset($_SESSION['admin_status'])){
														?>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#edit_addition<?php echo $row['id']?>"><i class="fa fa-pencil m-r-5"></i>
                                                    Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#delete_addition<?php echo $row['id']?>"><i class="fa fa-trash-o m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                            <?php
 }
 ?>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit Addition Modal -->
                                <div id="edit_addition<?php echo $row['id']?>" class="modal custom-modal fade" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Allowance</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
											<form method="post" action="task/edit_allawance.php">
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="<?php echo $row['name']?>" name="name">
                        </div>

                        <div class="form-group">
                            <label>Category <span class="text-danger">*</span></label> <br>
                            <select class="select" name="category">
                                <option>Select a category</option>
                                <option value="Monthly remuneration">Monthly remuneration</option>
                                <option value="Addtional remuneration">Additional remuneration</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Level <span class="text-danger">*</span></label> <br>
                            <select class="select" name="level">
                                <option>Select a level</option>
                                <?php
                                              for($i =6;$i<=13;$i++){
                                                  echo '<option value'.$i.'>'.$i.'</option>';
											  }
											 ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input type="text" class="form-control" value="<?php echo $row['amount']?>" name="amount">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                                <input type="hidden" name="id" value="<?php echo $row['id']?>">
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Edit Addition Modal -->

                                <!-- Delete Addition Modal -->
                                <div class="modal custom-modal fade" id="delete_addition<?php echo $row['id']?>" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="form-header">
                                                    <h3>Delete Allowance</h3>
                                                    <p>Are you sure want to delete?</p>
                                                </div>
                                                <div class="modal-btn delete-action">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a href="./task/delete_allawance.php?id=<?php echo $row['id']?>"
                                                                class="btn btn-primary continue-btn">Delete</a>
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
                                <!-- /Delete Addition Modal -->
                                <?php

}
?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /Payroll Additions Table -->

            </div>
            <!-- Additions Tab -->



            <!-- Deductions Tab -->
            <div class="tab-pane" id="tab_deductions">
                <?php

						if(isset($_SESSION['admin_status'])){

							?>
                <!-- Add Deductions Button -->
                <div class="text-right mb-4 clearfix">
                    <button class="btn btn-primary add-btn" type="button" data-toggle="modal"
                        data-target="#add_deduction"><i class="fa fa-plus"></i> Add Deduction</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#deduct_modal"><i
                            class="fa fa-plus"></i>Deduct Employee</a>

                </div>
                <!-- /Add Deductions Button -->
                <?php
						}
						 ?>
                <!-- Payroll Deduction Table -->
                <div class="payroll-table card">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Default/Unit Amount</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                          $object->query="
										  SELECT * FROM deduction_list
										  ";
										  $object->execute();
										  $res = $object->get_result();
										  foreach($res as $row){
										?>
                                <tr>
                                    <th><?php echo $row['deduction_name']?></th>
                                    <td>£<?php echo $row['amount'] ?></td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <?php
															 if(isset($_SESSION['admin_status'])){
															?>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#list_deduction"><i class="fa fa-pencil m-r-5"></i>
                                                    Affected staff</a>
                                                <?php
															 }
															?>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#edit_deduction<?php echo $row['id'] ?>"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#delete_deduction<?php echo $row['id'] ?>"><i
                                                        class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit Deduction Modal -->
                                <div id="edit_deduction<?php echo $row['id'] ?>" class="modal custom-modal fade"
                                    role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Deduction</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="task/edit_deduction.php">
                                                    <div class="form-group">
                                                        <label>Name <span class="text-danger">*</span></label>
                                                        <input class="form-control"
                                                            value="<?php echo $row['deduction_name'] ?>" type="text"
                                                            name="name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Amount</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">£</span>
                                                            </div>
                                                            <input type="text" value="<?php echo $row['amount'] ?>"
                                                                name="amount" class="form-control">
                                                            <input type="hidden" name="id"
                                                                value="<?php echo $row['id']?>">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">.00</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="submit-section">
                                                        <button class="btn btn-primary submit-btn">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Edit Addition Modal -->



                                <!-- Delete Deduction Modal -->
                                <div class="modal custom-modal fade" id="delete_deduction<?php echo $row['id'] ?>"
                                    role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="form-header">
                                                    <h3>Delete <?php echo $row['deduction_name'] ?> deduction</h3>
                                                    <p>Are you sure want to delete?</p>
                                                </div>
                                                <div class="modal-btn delete-action">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a href="./task/delete_deduction.php?id=<?php echo $row['id'] ?>"
                                                                class="btn btn-primary continue-btn">Delete</a>
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
                                <!-- /Delete Deduction Modal -->


                                <!-- List of affected staff Modal -->
                                <div id="list_deduction" class="modal custom-modal fade" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">List of Staff affeccted by
                                                    <?php echo $row['deduction_name'] ?></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?php 
						$month =  date('m');
						 $object->query ="
						 SELECT * FROM deductions WHERE month='$month' AND deduction_id='$row[id]'
						 ";
						 $object->execute();
						 $res2 = $object->get_result();
						 foreach($res2 as $row2){
						?>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="javascript:void(0);" data-dismiss="modal"
                                                            class="btn btn-primary continue-btn"><?php echo $object->get_employee_name($row2['emp_id'])?></a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="./task/delete_staff_deduction.php?id=<?php echo $row2['id'] ?>"
                                                            class="btn btn-primary cancel-btn">Delete Deduction</a>
                                                    </div>
                                                </div><br>
                                                <?php
						 }
						 ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /List of affected staff Modal -->

                                <?php
										  }
											?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /Payroll Deduction Table -->

            </div>
            <!-- /Deductions Tab -->

        </div>
        <!-- Tab Content -->

    </div>
    <!-- /Page Content -->

    <!-- Add Addition Modal -->
    <div id="add_addition" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Allowance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="task/add_allawance.php">
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name">
                        </div>

                        <div class="form-group">
                            <label>Category <span class="text-danger">*</span></label> <br>
                            <select class="select" name="category">
                                <option>Select a category</option>
                                <option value="Monthly remuneration">Monthly remuneration</option>
                                <option value="Addtional remuneration">Additional remuneration</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Level <span class="text-danger">*</span></label> <br>
                            <select class="select" name="level">
                                <option>Select a level</option>
                                <?php
                                              for($i =6;$i<=13;$i++){
                                                  echo '<option value'.$i.'>'.$i.'</option>';
											  }
											 ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input type="text" class="form-control" name="amount">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
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
    <!-- /Add Addition Modal -->




    <!-- Add Deduction Modal -->
    <div id="add_deduction" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Deduction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="task/add_deduction.php">
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name">
                        </div>

                        <div class="form-group">
                            <label>Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> £</span>
                                </div>
                                <input type="text" class="form-control" name="amount">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Deduction Modal -->

    <?php
                   $object->query="
				   SELECT * FROM employee
				   ";
				   $object->execute();
				   $res = $object->get_result();
				   
                   $object->query="
				   SELECT * FROM deduction_list
				   ";
				   $object->execute();
				   $res2 = $object->get_result();

				?>

    <!-- Deduct Employee Modal -->
    <div id="deduct_modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deduct Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="task/add_staff_deduction.php">

                        <div class="form-group">
                            <label>Staff <span class="text-danger">*</span></label>
                            <select class="select" name="emp_id" value="">
                                <option value="">Select Staff</option>
                                <?php 
											foreach($res as $row){
												echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
											}
											?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Deduction Type</label>
                            <select class="select" name="deduction_id" value="">
                                <option value="">Select Deduction Type</option>
                                <?php 
											foreach($res2 as $row2){
												echo '<option value='.$row2['id'].'>'.$row2['deduction_name'].'</option>';
											}
											?>
                            </select>
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Deduct Employee Modal -->



</div>
<!-- /Page Wrapper -->


<?php include('include/footer.php') ?>