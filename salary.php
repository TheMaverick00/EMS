<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="staff management system">
		<meta name="keywords" content="staff management system">
        <meta name="author" content="Joshua">
        <meta name="robots" content="noindex, nofollow">
        <title>staff management system</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favi.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="assets/css/line-awesome.min.css">
		
		<!-- Datatable CSS -->
		<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/css/select2.min.css">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		<!-- <script src="assets/js/jq.js"></script> -->
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
<?php include 'include/connection.php';?>
<?php include('include/nav.php') ?>
<?php include('include/sidenav.php') ?>
<div class="main-wrapper">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Page Wrapper -->
    <div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Staff Salary</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Salary</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_salary"><i class="fa fa-plus"></i> Add Salary</a>
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
                                        <th>Employee</th>
                                        <th>Employee ID</th>
                                        <th>Email</th>
                                        <th>Join Date</th>
                                        <th>Level</th>
                                        <th>Salary</th>
                                        <th>Payslip</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 
                                   
                                   $result = mysqli_query($conn,"SELECT  employee.id,employee.empID,employee.picture,employee.name,employee.email,employee.joiningDate, salary.salary,salary.empID,salary.hra,salary.loan,salary.basic,salary.level
                                   FROM employee INNER JOIN salary ON employee.empID = salary.empID;");

                                  
                                  while($row = mysqli_fetch_array($result)){?>
                                
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                            <?php if($row['picture']==""){
													?>
                                                <a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-10.jpg"></a>
                                                <?php }else{?>
                                                    <a href="#" class="avatar"><img alt="" src="pictures/<?php echo $row['picture'] ?>" width="40px" height="40px"></a>
                                              <?php  }?>
                                                <a href="profile.php"><?php echo $row['name'] ?> <span>Level: <?php echo $row['level'] ?> </span></a>
                                            </h2>
                                        </td>
                                        <td><?php echo $row['empID'] ?> </td>
                                        <td><?php echo $row['email'] ?> </td>
                                        <td><?php echo $row['joiningDate'] ?> </td>
                                        <td>
                                         
                                                <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo $row['level'] ?>  </a>
                                   
                                        </td>
                                        <td>£<?php echo $row['salary'] ?> </td>
                                        <td><a class="btn btn-sm btn-primary" href="salary-view?id=<?php echo $row['empID'] ?>">Generate Slip</a></td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="edit_salary?id=<?php echo $row['id'] ?>" data-toggle="modal" data-target="#edit_salary<?php echo $row['id'] ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="task/delete_salary?id=<?php echo $row['id'] ?>" data-toggle="modal" data-target="#delete_salary<?php echo $row['id'] ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                           <!-- Edit Salary Modal -->
            <div id="edit_salary<?php echo $row['id'] ?>" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit  <?php echo $row['name'] ?> info.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="task/edit_salary.php">
                                <input type="text" name="id" value="<?php echo $row['id'] ?>" hidden>
                                <input type="text" name="empID" value="<?php echo $row['empID'] ?>" hidden>
                                <div class="row"> 
                                    <div class="col-sm-12"> 
                                        <div class="form-group">
                                            <label>Staff</label> <br>
                                            <input class="form-control" value="<?php echo $row['name'] ?>" type="text" name="name" readonly>
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="row"> 
                                    <div class="col-sm-6"> 
                                        <h4 class="text-primary">Earnings</h4>
                                        <div class="form-group">
                                            <label>Basic</label>
                                            <input class="form-control" value="<?php echo $row['basic'] ?>"  type="text" name="basic">
                                        </div>
                                        <div class="form-group">
                                            <label>Level</label>
                                            <input class="form-control" value="<?php echo $row['level'] ?>" type="text" name="level"> 
                                        </div>
                                        <div class="form-group">
                                            <label>HRA(15%)</label>
                                            <input class="form-control" value="<?php echo $row['hra'] ?>"  type="text" name="hra">
                                        </div>
                                        <div class="form-group"> 
                                        <label>Net Salary</label>
                                        <input class="form-control" value="<?php echo $row['salary'] ?>"  type="text"  name="salary">
                                    </div>
                                    </div>
                                    <div class="col-sm-6">  
                                        <h4 class="text-primary">Deductions</h4>
                                       
                                        <div class="form-group">
                                            <label>Loan</label>
                                            <input class="form-control" value="<?php echo $row['loan'] ?>"  type="text" name="loan">
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Salary Modal -->   
            <!-- Delete Salary Modal -->
            <div class="modal custom-modal fade" id="delete_salary<?php echo $row['id'] ?>" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete Salary</h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="task/delete_salary.php?id=<?php echo $row['id'] ?>" class="btn btn-primary continue-btn">Delete</a>
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
            <!-- /Delete Salary Modal -->
                                    </tr>
                          
                                    <?php } ?>
                       
                          
                     
                                 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            
            <!-- Add Salary Modal -->
            <div id="add_salary" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Staff Salary</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="task/add_salary.php">
                                <div class="row"> 
                                    <div class="col-sm-12"> 
                                        <div class="form-group">
                                            <label>Select Staff</label> <br>
                                            <select class="select" name="empID" style="padding: 13px;width:100%;border:1px solid ash"> 

                                                 <?php 
                                                    
                                                    $res = mysqli_query($conn,"SELECT * FROM employee");
                                                    while($info = mysqli_fetch_array($res)){?>
                                                      <option value="<?php echo $info['empID'] ?>"><?php echo $info['name'] . " (" .$info['empID'] .")" ?></option>
                                                    <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="row"> 
                                    <div class="col-sm-6"> 
                                        <h4 class="text-primary">Earnings</h4>
                                        <div class="form-group">
                                            <label>Level</label>
                                            <?php
                            $sql = mysqli_query($conn,"SELECT * FROM level");
                           // $fetch = mysqli_fetch_array($sql);
                            
                        ?>
              <select id="level" class="form-control" name="level">
                                   <option value="">Select Level</option>
                                <?php while($row = mysqli_fetch_array($sql)){ ?>
                           
                              <option value="<?php echo $row['level'] ?>"> <?php echo $level = $row['level'] ?>
                              </option>
                                   <?php } ?>
                            </select>
                                        </div>
                                        <div class="form-group"> 
                                        <label>Net Salary</label>
                                        <!-- <input class="form-control" type="text" name="salary" id="salary"> -->
                                        <select name="salary" id="salary" class="form-control" readonly>
                </select>
                                    </div>
                                        <div class="form-group">
                                            <label>Basic</label>
                                            <input class="form-control" type="text" name="basic" id="basic"  readonly>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label>HRA(15%)</label>
                                            <input class="form-control" type="text" name="hra" id="hra"  readonly>
                                        </div>
                                      
                                    </div>
                                    <div class="col-sm-6">  
                                        <h4 class="text-primary">Deductions</h4>
                                        <!-- <div class="form-group">
                                            <label>TDS</label>
                                            <input class="form-control" type="text">
                                        </div>  -->
                                        <div class="form-group">
                                            <label>Loan</label>
                                            <input class="form-control" value="0" type="number" name="loan">
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
            <!-- /Add Salary Modal -->
            
        
         
        
            
        </div>
        <!-- /Page Wrapper -->

</div>

<script>
$(document).ready(function() {
$('#level').on('change', function() {
var level = this.value;
$.ajax({
url: "fetchsalary.php",
type: "POST",
data: {
level: level
},
cache: false,
success: function(result){
$("#salary").html(result);
var salary = document.getElementById("salary").value;
    document.getElementById("basic").value = salary* (60/100);
    document.getElementById("hra").value = salary* (40/100);
 //document.getElementById("basic").value = parseInt((this.salary * 60)/100);
}
});
 
});

// $('#level').on('change',function(){
   
//     var salary = document.getElementById("salary").value;
//     document.getElementById("basic").value = salary;
//     // var salary = this.value;
//     // $('#basic').val((this.salary*60)/100)
// })

});
</script>

<script>
//    function setBenefit(){
//        document.getEleme
//    }

</script>

<?php include('include/footer.php') ?>
