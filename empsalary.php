<?php 

include('class.php');

$object = new major;

$message = "";
 ?>

<?php include('include/header.php') ?>
<?php include 'include/connection.php';?>
<?php include('include/empnavbar.php') ?>
<?php include('include/empnav.php') ?>


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
                                    <h3 class="text-uppercase">Payslip #49029</h3>
                                    <ul class="list-unstyled">
                                        <li>Salary Month: <span> <?php echo date('M') ?> <?php echo date('Y') ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 m-b-20">
                                <ul class="list-unstyled">
                                    <li>
                                        <h5 class="mb-0"><strong><?php echo $_SESSION['name']?></strong></h5>
                                    </li>
                                    <li><span><?php echo $object->get_employee_dept($_SESSION['ID'])?></span></li>
                                    <li>Staff ID: <?php echo $_SESSION['EmpID']?></li>
                                    <li>Joined Amazon on: <?php echo $object->get_employee_join_date($_SESSION['ID'])?>
                                    </li>
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
                                                <td><strong>Basic Salary</strong> <span
                                                        class="float-right">£<?php echo $object->get_employee_basic_salary($_SESSION['EmpID']) ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>House Rent Allowance (H.R.A.)</strong> <span
                                                        class="float-right">£<?php echo $object->get_employee_hra($_SESSION['EmpID']) ?></span>
                                                </td>
                                            </tr>
                                            <?php

   $total_earnings=  $object->get_employee_basic_salary($_SESSION['EmpID']) + $object->get_employee_hra($_SESSION['EmpID']);
?>

                                            <tr>
                                                <td><strong>Total Earnings</strong> <span
                                                        class="float-right"><strong>£<?php echo $total_earnings ?></strong></span>
                                                </td>
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
                                                    $loan = $object->get_employee_loan($_SESSION['EmpID']);
                                                    $day = date('d');
                                                    $attendance = $object->get_present_times($_SESSION['ID']);
                                                     
                                                    $attendance_percent = $attendance / $day;
                                                    // checking if the month is greater than 15
                                                    if($day >= 16 ){
                                                        // checking if the attendance of the staff is less than 15
                                                         if($attendance_percent < 0.5){
                                                            // logic to deduct salary
                                                                $message ="Contact the HR department for more details about your salary";
                                                         
                                                         }else{
                                                          
                                                             $message ='';
                                                    }
                                                }
                                                             
                                                            $salary = $object->get_employee_basic_salary($_SESSION['EmpID']);
                                                            $deduction = $object->get_staff_deduction($_SESSION['ID']);
                                                            $object->query="
                                                             UPDATE salary SET basic='$salary' WHERE empID='$_SESSION[EmpID]'
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

    $object->query="
    SELECT * FROM deductions WHERE emp_id='$_SESSION[ID]' AND month='$month'
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
                                                <td><strong>Total Deductions</strong> <span
                                                        class="float-right"><strong>£<?php echo $final_deduction ?></strong></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <p><strong>Net Salary: £<?php echo $net_salary ?></strong></p>
                                <p><?php echo $message ?></p>
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

</div>
<!-- /Main Wrapper -->
<?php include('include/footer.php') ?>