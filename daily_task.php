<?php
 
 include('class.php');
 $object = new major;
function display_msg($message) {
    // Display message
    echo "<script>alert('$message');</script>";
}

$msg = "";
?>
<?php include('include/header.php') ?>
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
                    <h3 class="page-title">Daily Task</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Task</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i
                            class="fa fa-plus"></i> Add Task</a>
                    <!-- <div class="view-icons">
                        <a href="attendance.php" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
                        <a href="employees.php" class="list-view btn btn-link active"><i
                                class="fa fa-bars"></i></a>
                    </div> -->
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
                                <th>Task Title</th>
                                <th>Assigned To</th>
                                <th>Department</th>
                                <th>Task Duration</th>
                                <th>Punch In Time</th>
                                <th class="text-nowrap">Signed In Since</th>
                                <th>Complete Status</th>
                                <th class="text-right no-sort">Action </th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php 
                                      $today = $object->today;
                                        $object->query="
                                        SELECT * FROM task WHERE  (date LIKE '$today%') AND (assigned_by='$_SESSION[ID]')
                                        
                                        ";
                                        $object->execute();
                                        $res = $object->get_result();
                                   //echo// $today;
                                  foreach($res as $row){?>

                            <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="profile.php" class="avatar"><img alt=""
                                                src="assets/img/profiles/avatar-10.jpg"></a>
                                        <a href="profile.php">
                                            <?php echo $row['task_title']  ?> </a>
                                    </h2>
                                </td>
                                <td>
                                    <?php echo $object->get_employee_name($row['assigned_to'])?>
                                </td>
                                <td>
                                    <?php echo $object->get_employee_dept($row['assigned_to'])  ?>
                                </td>
                                <td>
                                    <?php echo $row['duration'].' hours'  ?>
                                </td>
                                <td>
                                    <?php echo $object->get_employee_punch_in_time($row['assigned_to'])  ?>
                                </td>
                                <td>
                                    <?php echo $object->GetTimeDiff(strtotime($row['date']))  ?>
                                </td>
                                <td>
                                    <?php 
                                         if($row['complete_status']==1){
                                            echo     '<span class="badge bg-inverse-success">Completed </span>';
                                      }else{
                                          echo     '<span class="badge bg-inverse-primary">Incomplete</span>';
                                      }
                                        ?>
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
                                            <h5 class="modal-title">Edit Task</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="task/edit_task.php">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Task <span
                                                                    class="text-danger">*</span></label>
                                                            <input class="form-control"
                                                                value="<?php echo $row['task_title']; ?>" type="text"
                                                                name="name">
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Duration <span
                                                                    class="text-danger">*</span></label>
                                                            <input class="form-control"
                                                                value="<?php echo $row['duration']; ?>" type="text"
                                                                name="duration">
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Employee <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text"
                                                                value="<?php echo $object->get_employee_name($row['assigned_to']); ?>"
                                                                name="empId" readonly class="form-control floating">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Complete Status<span
                                                                    class="text-danger">*</span></label>
                                                            <select class="select" name="complete">
                                                                <?php 

													$complete = $row['complete_status'];
                                                    
                                                    if($complete == 1){
                                                    ?>
                                                                <option value="<?php echo $row['complete_status'] ?>">
                                                                    Completed</option>
                                                                <option value="0">Incomplete</option>

                                                                <?php }else{
                                                    
                                                    ?>
                                                                <option value="<?php echo $row['complete_status'] ?>">
                                                                    Incomplete</option>
                                                                <option value="1">Completed</option>

                                                                <?php
                                                    }
                                                    ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <input name="id" value="<?php echo $row['id'] ?>" hidden>
                                                    <div class="submit-section">
                                                        <button type="submit"
                                                            class="btn btn-primary submit-btn">Update</button>
                                                    </div>
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
                                                            href="task/delete_task.php?id=<?php echo $row['id'] ?>"
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

    <!-- Add Task Modal -->
    <div id="add_employee" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-danger text-center"><?php echo $msg; ?></p>
                    <form method="post" action="task/add_task.php">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Task Title <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="task" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Duration <span class="text-danger">*</span></label>
                                    <input class="form-control" placeholder="Enter duration in hour" type="text"
                                        name="duration" required>
                                </div>
                            </div>




                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select staff <span class="text-danger">*</span></label>
                                    <select class="select" name="employee">
                                        <?php 

													$result = mysqli_query($conn,"SELECT * FROM employee WHERE isAdmin='0'");
														$i=1;
													while($row = mysqli_fetch_array($result)) {?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>

                                        <?php }  ?>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Task Modal -->



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