<?php 
include('class.php');
include('include/header.php');
$object = new major;
?>
<?php include 'include/connection.php';?>
<?php include('include/nav.php') ?>
<?php include('include/sidenav.php') ?>


<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Approval List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Approval List</li>
                    </ul>
                </div>
                <?php
                    if(isset($_SESSION['admin_status'])){
                ?>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i
                            class="fa fa-plus"></i> Add Employee to approve</a>

                </div>
                <?php
                    }
                ?>
            </div>
        </div>
        <!-- /Page Header -->



        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>Responsibility</th>
                                <th>Level</th>
                                <th class="text-right no-sort">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php 
                                   $object->query="
                                   SELECT * FROM approval_list
                                   ";
                                   $object->execute();
                                   $res = $object->get_result();
                                   foreach($res as $row)
                                   {
                                      ?>

                            <tr>
                                <td>
                                   
                                            <?php echo $object->get_employee_name($row['emp_id'])   ?>
                                    
                                </td>
                                <td>
                                    <?php echo  $row['responsibility'] ?>
                                </td>
                                <td>
                                    <?php echo $row['level']  ?>
                                </td>


                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#edit<?php echo $row['id']; ?>"><i
                                                    class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#delete<?php echo $row['id'] ?>"><i
                                                    class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Edit Employee Modal -->
                            <div id="edit<?php echo $row['id']; ?>" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Approval List</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="task/edit_approval.php">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Responsibility <span
                                                                    class="text-danger">*</span></label>
                                                            <input class="form-control"
                                                                value="<?php echo $row['responsibility']; ?>" type="text"
                                                                name="responsibility">
                                                        </div>
                                                    </div>

                                                    <?php
      $object->query="
      SELECT * FROM employee
      ";
      $object->execute();
      $res2 = $object->get_result();
                                     ?>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Staff <span class="text-danger">*</span></label>
                                                            <select class="select" name="emp_id" value="">
                                                                <option value="">Select Staff</option>
                                                                <?php 
											foreach($res2 as $row2){
												echo '<option value='.$row2['id'].'>'.$row2['name'].'</option>';
											}
											?>
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-6">
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
                                                    </div>

                                                </div>
                                                <input name="id" value="<?php echo $row['id'] ?>" hidden>
                                                <div class="submit-section">
                                                    <button class="btn btn-primary submit-btn">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Edit Employee Modal -->


                            <!-- Delete Employee Modal -->
                            <div class="modal custom-modal fade" id="delete<?php echo $row['id'] ?>" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-header">
                                                <h3>Delete Employee</h3>
                                                <p>Are you sure want to delete?</p>
                                            </div>
                                            <div class="modal-btn delete-action">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <!-- <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a> -->
                                                        <a name="delete"
                                                            href="task/delete_approval.php?id=<?php echo $row['id'] ?>"
                                                            class="btn btn-primary continue-btn col-md-12">Delete</a>
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
                            <!-- /Delete Employee Modal -->


                            <?php } ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Add Employee Modal -->
    <div id="add_employee" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Designation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="task/add_approval.php">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Responsibility<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="responsibility">
                                </div>
                            </div>

                            <?php
      $object->query="
      SELECT * FROM employee
      ";
      $object->execute();
      $res2 = $object->get_result();
                                     ?>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Staff <span class="text-danger">*</span></label>
                                    <select class="select" name="emp_id">
                                        <option value="">Select Staff</option>
                                        <?php 
											foreach($res2 as $row2){
												echo '<option value='.$row2['id'].'>'.$row2['name'].'</option>';
											}
											?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-6">
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
    <!-- /Add Employee Modal -->


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