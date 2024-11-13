<?php 
include('include/header.php');
include('class.php');

$object = new major;

?>
<?php include 'include/connection.php';?>
<?php include('include/nav.php') ?>
<?php include('include/sidenav.php') ?>

<?php

      $object->query="
      SELECT * FROM employee
      ";
      $object->execute();
      $res = $object->get_result();
?>


<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Leaves</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Leaves</li>
                    </ul>
                </div>

                <?php 
                               if(isset($_SESSION['admin_status'])){
                        ?>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i
                            class="fa fa-plus"></i> Add Leave</a>
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
                    <table class="table table-striped custom-table mb-0 datatable">>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>

                        <?php

                                    $object->query="
                                    SELECT * FROM leaves
                                    ";
                                    $object->execute();
                                    $res = $object->get_result()
?>
                        <tbody>

                            <?php
foreach($res as $row){
if($row['status'] == 1){
$status = "Completed";
}else{
    $status = "Uncompleted";
}

?>
                            <tr>
                                <td><?php echo $object->get_employee_name($row['id'])?></td>
                                <td><?php echo $row['leave_type'] ?></td>
                                <td><?php echo $status ?></td>
                                <td><?php echo $row['no_of_days']?></td>
                                <td><?php echo $row['reason']?></td>
                                <td>Going to Hospital</td>
                         
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
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

    <!-- Add Leave Modal -->
    <div id="add_leave" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="./task/add_leave.php">
                        <div class="form-group">
                            <label>Leave Type <span class="text-danger">*</span></label>
                            <select name="leave_type" class="select">
                                <option>Select Leave Type</option>
                                <option value="Casual Leave">Casual Leave 12 Days</option>
                                <option value="Medical Leave">Medical Leave</option>
                                <option value="Loss of pay">Loss of Pay</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Number of days <span class="text-danger">*</span></label>
                            <input class="form-control" name="no_of_days" type="text">
                        </div>

                        <div class="form-group">
                            <label>Staff <span class="text-danger">*</span></label>
                            <select class="select2" name="emp_id" value="">
                                <option value="">Select Staff</option>
                                <?php 
											foreach($res as $row){
												echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
											}
											?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Leave Reason <span class="text-danger">*</span></label>
                            <textarea rows="4" name="reason" class="form-control"></textarea>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Leave Modal -->

    <!-- Edit Leave Modal -->
    <div id="edit_leave" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Leave Type <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select Leave Type</option>
                                <option>Casual Leave 12 Days</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>From <span class="text-danger">*</span></label>
                            <div class="cal-icon">
                                <input class="form-control datetimepicker" value="01-01-2019" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>To <span class="text-danger">*</span></label>
                            <div class="cal-icon">
                                <input class="form-control datetimepicker" value="01-01-2019" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Number of days <span class="text-danger">*</span></label>
                            <input class="form-control" readonly type="text" value="2">
                        </div>
                        <div class="form-group">
                            <label>Remaining Leaves <span class="text-danger">*</span></label>
                            <input class="form-control" readonly value="12" type="text">
                        </div>
                        <div class="form-group">
                            <label>Leave Reason <span class="text-danger">*</span></label>
                            <textarea rows="4" class="form-control">Going to hospital</textarea>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Leave Modal -->

    <!-- Approve Leave Modal -->
    <div class="modal custom-modal fade" id="approve_leave" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Leave Approve</h3>
                        <p>Are you sure want to approve for this leave?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="javascript:void(0);" class="btn btn-primary continue-btn">Approve</a>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-dismiss="modal"
                                    class="btn btn-primary cancel-btn">Decline</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Approve Leave Modal -->

    <!-- Delete Leave Modal -->
    <div class="modal custom-modal fade" id="delete_approve" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Leave</h3>
                        <p>Are you sure want to delete this leave?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
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
    <!-- /Delete Leave Modal -->

</div>
<!-- /Page Wrapper -->













<?php include('include/footer.php') ?>