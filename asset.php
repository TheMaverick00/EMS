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

	<!-- Page Wrapper -->
    <div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Assets</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Assets</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_asset"><i class="fa fa-plus"></i> Add Asset</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <!-- Search Filter -->
                <div class="row filter-row">
                    <!-- <div class="col-sm-6 col-md-6">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Employee Name</label>
                        </div>
                    </div> -->
                    <!-- <div class="col-sm-6 col-md-3"> 
                        <div class="form-group form-focus select-focus">
                            <select class="select floating"> 
                                <option value=""> -- Select -- </option>
                                <option value="0"> Pending </option>
                                <option value="1"> Approved </option>
                                <option value="2"> Returned </option>
                            </select>
                            <label class="focus-label">Status</label>
                        </div>
                    </div> -->
                    <div class="col-sm-12 col-md-4">  
                       <div class="row">  
                           <!-- <div class="col-md-6 col-sm-6">  
                                <div class="form-group form-focus">
                                    <div class="cal-icon">
                                        <input class="form-control floating datetimepicker" type="text">
                                    </div>
                                    <label class="focus-label">From</label>
                                </div>
                            </div> -->
                           <!-- <div class="col-md-6 col-sm-6">  
                                <div class="form-group form-focus">
                                    <div class="cal-icon">
                                        <input class="form-control floating datetimepicker" type="text">
                                    </div>
                                    <label class="focus-label">To</label>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <!-- <div class="col-sm-6 col-md-2">  
                        <a href="#" class="btn btn-success btn-block"> Search </a>  
                    </div>      -->
                </div>
                <!-- /Search Filter -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>Asset User</th>
                                        <th>Asset Name</th>
                                        <th>Asset Id</th>
                                        <th>Purchase Date</th>
                                        <th>Condition</th>
                                        <th>Manufacturer</th>
                                        <th>Amount</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                   <?php 
                                       $result = mysqli_query($conn,"SELECT * FROM assets");
                                       while($row = mysqli_fetch_array($result)){?>


                                    
                                    <tr>
                                        <td><?php echo $row['user'] ?> </td>
                                        <td>
                                            <strong><?php echo $row['name'] ?></strong>
                                        </td>
                                        <td><?php echo $row['assetID'] ?></td>
                                        <td><?php echo $row['purchase_date'] ?></td>
                                        <td><?php echo $row['condition'] ?></td>
                                        <td><?php echo $row['manufacturer'] ?></td>
                                        <td><?php echo $row['amount'] ?></td>
                                        <td class="text-center">
                                            <div class=" action-label">
                                                <a class="btn btn-white btn-sm btn-rounded"  aria-expanded="false">
                                                     <?php
                                                     if( $row['status'] =="Approved"){?>
                                                        <i class="fa fa-dot-circle-o text-success"></i> <?php echo $row['status'] ?>
                                                    <?php } else{ ?>
                                                        <i class="fa fa-dot-circle-o text-danger"></i> <?php echo $row['status'] ?>
                                                  <?php  }
                                                     
                                                     ?>
                                                </a>
                                                <!-- <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Pending</a>
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Approved</a>
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Returned</a>
                                                </div> -->
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit<?php echo $row['id'] ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete<?php echo $row['id'] ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                         <!-- Edit Asset Modal -->
            <div id="edit<?php echo $row['id'] ?>" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Asset</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form method="POST" action="task/edit_asset.php">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Asset Name</label>
                                            <input name="id" type="text" value="<?php echo $row['id'] ?>" hidden>
                                            <input class="form-control" type="text" name="name" value="<?php echo $row['name'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Asset Id</label>
                                            <input class="form-control" type="text" name="assetID" value="<?php echo $row['assetID'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Purchase Date</label>
                                            <input class="form-control datetimepicker" type="text" name="purchase_date" value="<?php echo $row['purchase_date'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Purchase Amount</label>
                                            <input placeholder="₦ 18000" class="form-control" type="text" name="amount" value="<?php echo $row['amount'] ?>">
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Manufacturer</label>
                                            <input class="form-control" type="text" name="manufacturer" value="<?php echo $row['manufacturer'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Condtion</label>
                                            <input class="form-control" type="text" name="condition" value="<?php echo $row['condition'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Serial Number</label>
                                            <input class="form-control" type="text" name="sn" value="<?php echo $row['sn'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Supplier</label> 
                                            <input class="form-control" type="text" name="supplier" value="<?php echo $row['supplier'] ?>">
                                        </div>
                                    </div>
                            
                                </div>
                                <div class="row">
                                  
                                    <div class="col-md-6">
                                    
                            
                  
                                       
                                        <div class="form-group">
                                            <label>Asset User</label>
                                            <select class="select" class="form-control" name="user" >

                                               
                                                                          <option><?php echo $row['user'] ?></option>
                                                    
                                                
                                              
                                            </select>
                                        </div>
                                    </div>
                                 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="select" name="status">

                                                <!-- <option value="<?php echo $row['status'] ?>"><?php echo $row['status'] ?></option> -->
                                                <option value="Approved">Approved</option>
                                                <option value="Deployed">Deployed</option>
                                                <option value="Damaged">Damaged</option>
                                            </select>
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
            <!-- Edit Asset Modal -->
               <!-- Delete Asset Modal -->
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
                                    <div class="col-6">
                                        <!-- <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a> -->
                                        <a name="delete" href="task/delete_asset.php?id=<?php echo $row['id'] ?>"  class="btn btn-primary continue-btn col-md-12">Delete</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Delete Asset Modal -->
                                        
                                    </tr>
                                     
                                    <?php } ?>
                                  
                                   
                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
        
            <!-- Add Asset Modal -->
       
            <div id="add_asset" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Asset</h5>
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
                                            <input class="form-control" type="text" name="assetID" value="<?php echo "AST"."-".rand(10,10000)."-FGN" ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Purchase Date</label>
                                            <input class="form-control datetimepicker" type="date" name="purchase_date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Purchase Amount</label>
                                            <input placeholder="₦ 18000" class="form-control" type="text" name="amount">
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Manufacturer</label>
                                            <input class="form-control" type="text" name="manufacturer">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Condtion</label>
                                            <input class="form-control" type="text" name="condition">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Serial Number</label>
                                            <input class="form-control" type="text" name="sn">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Supplier</label> 
                                            <input class="form-control" type="text" name="supplier">
                                        </div>
                                    </div>
                            
                                </div>
                                <div class="row">
                                  
                                    <div class="col-md-6">
                                    
                            
                  
                                       
                                        <div class="form-group">
                                            <label>Asset User</label>
                                            <select class="select" class="form-control" name="user">

                                                <?php 

                                                    $result = mysqli_query($conn,"SELECT * FROM employee");
                                                    $i=1;
                                                    while($row = mysqli_fetch_array($result)) {?>
                                                                          <option><?php echo $row['empID'] ?></option>
                                                    
                                                  <?php }  ?>
                                              
                                            </select>
                                        </div>
                                    </div>
                                 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="select" name="status">
                                                <option value="Pending">Pending</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Deployed">Deployed</option>
                                                <option value="Damaged">Damaged</option>
                                            </select>
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
        <!-- /Page Wrapper -->
        
    </div>
    <!-- /Main Wrapper -->


    <?php include('include/footer.php') ?>