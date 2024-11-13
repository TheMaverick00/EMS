
<?php 

include('class.php');

$object = new major;
 ?>
<?php include('include/header.php') ?>
<?php include 'include/connection.php';?>
<?php include('include/nav.php') ?>
<?php include('include/sidenav.php') ?>

<?php

$empID = $_GET['id'];
$message = "";
?>

<?php 
                                   
                                   $result = mysqli_query($conn,"SELECT employee.id,employee.empID,employee.name,employee.email,employee.joiningDate, salary.salary,salary.level,salary.basic,salary.hra,salary.loan
                                   FROM employee INNER JOIN salary ON employee.empID = salary.empID WHERE employee.empID='$empID'");
                                   $row = mysqli_fetch_array($result);
                              
 ?>
	<!-- Page Wrapper -->
    <div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Payslip</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Payslip</li>
                            </ul>
                        </div>
                        <!-- <div class="col-auto float-right ml-auto">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-white">CSV</button>
                                <button class="btn btn-white">PDF</button>
                                <button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="payslip-title">Payslip for the month of <?php echo date('M') ?>
                              <?php echo date('Y') ?></h4>
                                <div class="row">
                                    <div class="col-sm-6 m-b-20">
                                        <!-- <img src="assets/img/favi.png" class="inv-logo" alt=""> -->
                                       
                                    </div>
                                    <div class="col-sm-6 m-b-20">
                                        <div class="invoice-details">
                                            <h3 class="text-uppercase">Payslip <?php echo $empID ?></h3>
                                            <ul class="list-unstyled">
                                            <li> <span> <?php echo date('M') ?> <?php echo date('Y') ?></span></li>
                                            
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 m-b-20">
                                        <ul class="list-unstyled">
                                            <li><h5 class="mb-0"><strong><?php echo $row['name'] ?></strong></h5></li>
                                            <li><span>Level: <?php echo $row['level'] ?></span></li>
                                            <li>Staff ID: <?php echo $row['empID'] ?></li>
                                            <li>Joining Date: <?php echo $row['joiningDate'] ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div>
                                            <h4 class="m-b-10"><strong>Earnings</strong></h4>
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Basic Salary</strong> <span class="float-right">£ <?php echo $row['basic'] ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>House Rent Allowance (H.R.A.)</strong> <span class="float-right">£<?php echo $row['hra'] ?></span></td>
                                                    </tr>
                                                  
                                                    <tr>
                                                 <?php   $total_earnings=  $object->get_employee_basic_salary($row['empID']) + $object->get_employee_hra($row['empID']); ?>
                                                        <td><strong>Total Earnings</strong> <span class="float-right"><strong>£<?php echo $total_earnings ?></strong></span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div>
                                            <h4 class="m-b-10"><strong>Deductions</strong></h4>
                                            <table class="table table-bordered">
                                                <tbody>
                                                <?php 
                                                    $loan = $object->get_employee_loan($row['empID']);
                                                    $day = date('d');
                                                    $attendance = $object->get_present_times($row['id']);
                                                     $status = '';
                                                    $attendance_percent = $attendance / $day;
                                                    // checking if the days in  month is greater than 15
                                                    if($day >= 16 ){
                                                        // checking if the attendance of the staff is less than 15
                                                         if($attendance_percent < 0.5){
                                                            // logic to deduct salary
                                                                $message ="Contact the HR department for more details about your salary";
                                                                $status ="Payment Not Approve";
                                                         }else{
                                                          
                                                             $message ='';
                                                             $status = "Payment Has been approved";  
                                                    }
                                                }
                                                             
                                                            $salary = $object->get_employee_basic_salary($row['empID']);
                                                            $deduction = $object->get_staff_deduction($row['id']);
                                                            $object->query="
                                                             UPDATE salary SET basic='$salary' WHERE empID='".$row['empID']."'
                                                            ";
                                                            $object->execute();
                                                            $final_deduction = $deduction+ $loan;
                                                            $net_salary = $total_earnings - $final_deduction;
                                                            if($net_salary <0){
                                                                $net_salary = 0;
                                                            }

                                                    ?>
                                            <tr>
                                                <td><strong>Loan</strong> <span
                                                        class="float-right">£<?php echo $loan ?></span></td>
                                            </tr>

                                            <?php
    $month = date('m');
    $id = $row['id'];
    $object->query="
    SELECT * FROM deductions WHERE emp_id='$id' AND month='$month'
    ";
    $object->execute();
    $res = $object->get_result();
    foreach($res as $row){
                                            ?>
                                            <tr>
                                                <td><strong><?php echo $object->get_deduction_type($row['deduction_id']) ?></strong>
                                                    <span class="float-right">£<?php echo $row['amount']?></span>
                                                </td>
                                            </tr>

                                            <?php
    }
                                            ?>
                                                    <tr>
                                                        <td><strong>Total Deductions</strong> <span class="float-right"><strong><?php echo $loan  ?></strong></span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <p><strong>Net Salary: £<?php echo $net_salary ?></strong></p>
                                        <p class="text-center text-danger"><?php echo $message ?></p>
                                        <!-- <li> <span> <?php echo $status ?> </span></li> -->

                                        <?php
                                            if($message==""){?>
                                                         <p class="text-center text-success"> <span> <?php echo $status ?> </span></p>
                                          <?php  }else{?>
                                            <p class="text-center text-danger"> <span> <?php echo $status ?> </span></p> 
                                         <?php  }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            
        </div>
        <!-- /Page Wrapper -->



<?php include('include/footer.php') ?>
