<?php include('include/header.php') ?>
<!-- <?php 
include('include/connection.php') ;
include('class.php');
$object = new major;

$attendance_marker = $object->check_today_attedance();  



?> -->
<?php
// session_start();
if(isset($_SESSION['ID']) || isset($_SESSION['Email']))      // if there is no valid session
{
    header("Location: index.php");
}
$msg = "";
if(isset($_POST['submit']))
{
    extract($_POST);
 
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $encpass = md5($password);
    include 'include/connection.php';
    $sql=mysqli_query($conn,"SELECT * FROM employee where email='$email' AND password='$encpass'");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {
         if($row['isAdmin']== 1){
            $_SESSION["ID"] = $row['id'];
            $_SESSION["Email"]= $row['email'];
            $_SESSION['name']  = $row['name'];
            $_SESSION['EmpID'] = $row['empID'];
            $_SESSION['admin_status'] = 1;

            header("Location: index.php"); 
         }else{
             $_SESSION['EmpID'] = $row['empID'];
            $_SESSION["ID"] = $row['id'];
            $_SESSION["Email"]= $row['email'];
            $_SESSION['name']  = $row['name'];

            if($attendance_marker == 0){
            header("Location: attendance-employee.php");
            }else{
                header('Location: empdashboard.php');
            }
         }

    }
    else
    {
        $msg=  "Invalid login credentials";
    }
}
?>
<body class="account-page">
<div class="main-wrapper">
        <div class="account-content">
            <div class="container">
                		<!-- Account Logo -->
				
					<!-- /Account Logo -->
                <div class="account-box b-1">
                    <div class="account-wrapper">
                        <h3 class="account-title">Login Panel</h3>
                        <p class="text-danger text-center"><?php echo $msg; ?></p>

                        <!-- Account Form -->
                        <form action="" method="POST">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input class="form-control" type="text" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Password</label>
                                    </div>

                                </div>
                                <input class="form-control" type="password" name="password" id="password">

                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn" type="submit" name="submit">Login</button>
                            </div>
                            <div class="account-footer">
                                <!-- <a class="text-muted" href="forgot-password.php">
										Forgot password?
									</a> -->
                            </div>
                        </form>
                        <!-- /Account Form -->

                    </div>
                </div>
            </div>
        </div>
    </div>