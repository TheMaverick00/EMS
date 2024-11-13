<?php session_start(); ?>
<?php include('include/header.php') ?>
<?php include 'include/connection.php';?>
<?php include('include/nav.php') ?>
<?php include('include/sidenav.php') ?>

<style>
       select{
                padding:13px;
                width:100%;
                border-color:#dee2e6;
             }
</style>

<?php
   if(isset($_POST['save']))
   {
      $checkbox = $_POST['check'];         
          
           mysqli_query($conn,"insert into checkbox (category_id,subcategory_id) values ('1','".$check_id."')") or die(mysqli_error());
            
       
   }

?>
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Staff</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Staff</li>
                            </ul>
                        </div>
                        <!-- <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Add User</a>
                        </div> -->
                    </div>
                </div>
                <!-- /Page Header -->
                
                <!-- Search Filter -->
                <!-- <div class="row filter-row">
                    <div class="col-sm-6 col-md-8">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Name</label>
                        </div>
                    </div>
                  
                
                    <div class="col-sm-6 col-md-4">  
                        <a href="#" class="btn btn-success btn-block"> Search </a>  
                    </div>     
                </div> -->
                <!-- /Search Filter -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table datatable">
                                <thead>
                                    <tr>
                                        <th>Sn</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Company</th>
                                        <th>Created Date</th>
                                        <th>Role</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                            $result = mysqli_query($conn,"SELECT * FROM employee");
				                    	    $i=1;
				                    	    while($row = mysqli_fetch_array($result)) {?>

                                    <tr>
                                        <td> <?php echo $i++ ?> </td>
                                        <td>
                                            <h2 class="table-avatar">
                                            <?php if($row['picture']==""){
													?>
                                                <a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-10.jpg"></a>
                                                <?php }else{?>
                                                    <a href="#" class="avatar"><img alt="" src="pictures/<?php echo $row['picture'] ?>" width="40px" height="40px"></a>
                                              <?php  }?>
                                                <a href="profile.php"><?php echo $row['name'];  ?> <span><?php echo $row['empID'];  ?> </span></a>
                                            </h2>
                                        </td>
                                        <td><?php echo $row['email'];  ?></td>
                                        <td><?php echo $row['department'];  ?></td>
                                        <td><?php echo $row['joiningDate'];  ?></td>
                                        <td>
                                                   <?php
                                                     if($row['isAdmin']==1){
                                                          echo     '<span class="badge bg-inverse-success">Admin ♕</span>';
                                                    }else{
                                                        echo     '<span class="badge bg-inverse-primary">Employee</span>';
                                                    }
                                                   ?>    
                                        </td>
                                        <td class="text-right" >
                                               <?php 


                                                   
                                                   if($row['isAdmin']==1){
                                                    echo     '
                                                    <form method="post" action="task/remove_admin.php">
                                                           
                                                            <button class="btn btn-danger btn-sm"><a href="task/remove_admin.php?id='.$row['id'].'" class="text-white">Change</a></button>
                                                    </form>
                                                    ';
                                              }else{
                                                echo     '
                                                <form method="post" action="task/make_admin.php">
                                         
                                                <button class="btn btn-success btn-sm"><a href="task/make_admin.php?id='.$row['id'].'" class="text-white">Change</a></button>
                                                </form>
                                               ';
                                              }
                                                 
                                               ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            
     
            
            <!-- Edit User Modal -->
            <div id="edit_user" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>First Name <span class="text-danger">*</span></label>
                                            <input class="form-control" value="John" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input class="form-control" value="Doe" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Username <span class="text-danger">*</span></label>
                                            <input class="form-control" value="johndoe" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Email <span class="text-danger">*</span></label>
                                            <input class="form-control" value="johndoe@example.com" type="email">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" type="password">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input class="form-control" type="password">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Phone </label>
                                            <input class="form-control" value="9876543210" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select class="select">
                                                <option>Admin</option>
                                                <option>Client</option>
                                                <option selected>Employee</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Company</label>
                                            <select class="select">
                                                <option>Global Technologies</option>
                                                <option>Delta Infotech</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label>Employee ID <span class="text-danger">*</span></label>
                                            <input type="text" value="FT-0001" class="form-control floating">
                                        </div>
                                   </div>
                                </div>
                                <div class="table-responsive m-t-15">
                                    <table class="table table-striped custom-table">
                                        <thead>
                                            <tr>
                                                <th>Module Permission</th>
                                                <th class="text-center">Read</th>
                                                <th class="text-center">Write</th>
                                                <th class="text-center">Create</th>
                                                <th class="text-center">Delete</th>
                                                <th class="text-center">Import</th>
                                                <th class="text-center">Export</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Employee</td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Holidays</td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Leaves</td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Events</td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                                <td class="text-center">
                                                    <input checked="" type="checkbox">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit User Modal -->
        
            
        </div>
        <!-- /Page Wrapper -->





<?php include('include/footer.php') ?>
