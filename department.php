<?php session_start(); ?>
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
                            <h3 class="page-title">Department</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Department</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_department"><i class="fa fa-plus"></i> Add Department</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">#</th>
                                        <th>Department Name</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                              <?php
                                $result = mysqli_query($conn,"SELECT * FROM department");
				              	$i=1;
                                
				             	while($row = mysqli_fetch_array($result)) {?>
                                    <tr>
                  
                                        <td><?php echo $i++ ?></td>
                                        <td><?php echo $row['name'];  ?></td>
                                        <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="department.php?id=<?php echo $row['id'] ?>" data-toggle="modal" data-target="#edit<?php echo $row['id'] ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete<?php echo $row['id'] ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                            </div>
                                        </td>
                         <!-- Edit Department Modal -->
                     <div id="edit<?php echo $row['id'] ?>" class="modal custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                         <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Department</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="task/edit_department.php">
                                <div class="form-group">
                                    <label>Department Name <span class="text-danger">*</span></label>
                                    <input class="form-control" name="depart" value="<?php echo $row['name']?>" type="text">
                                    <input name="id" value="<?php echo $row['id'] ?>" hidden>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Save</button>
                                    <!-- <a name="edit" href="task/edit_department.php?id=<?php //echo $row['id'] ?>"  class="btn btn-primary submit-btn">Save</a> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Department Modal -->
               <!-- Delete Department Modal -->
          
               <div class="modal custom-modal fade" id="delete<?php echo $row['id'] ?>" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete <?php echo $row['name'] ?></h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <form method="POST">
                                    <div class="col-6">
                                        <a name="delete" href="task/delete_departement.php?id=<?php echo $row['id'] ?>"  class="btn btn-primary continue-btn col-md-12">Delete</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                 </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Delete Department Modal -->
                                    </tr>
                                 <?php } ?>
                            
                          
                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
         
   
         
            
            <!-- Add Department Modal -->
            <div id="add_department" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Department</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                   
                        <div class="modal-body">
                            <form method="post" action="task/add_department.php">
                                <div class="form-group">
                                    <label>Department Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="depart">
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" name="add">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Department Modal -->
            

            
        </div>
        <!-- /Page Wrapper -->





<?php include('include/footer.php') ?>
