<?php include('include/header.php') ?>
<!-- <?php include('include/connection.php') ?> -->
<?php
session_start();
function display_msg($message) {
    // Display message
    echo "<script>alert('$message');</script>";
}

$msg = "";
if(isset($_POST['submit']))
{
    extract($_POST);
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
   
    
    include 'include/connection.php';
    $sql=mysqli_query($conn,"SELECT * FROM admin where email='$email'");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {
        $msg = "Email Already registered";
     
    }else if($pass != $cpass){
        $msg = "password does not match";
    }
    else
    {
        $encPass = md5($pass);
        $sql = "INSERT INTO admin(name,email,password) VALUES('$name','$email','$encPass')";
        if(mysqli_query($conn,$sql)){
            display_msg("Registeration successful");
            header("Location: login.php");  
        }
    }
}
?>
<body class="account-page">
<div class="main-wrapper">
			<div class="account-content">
			
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index.php"><img src="assets/img/logo.png" alt="fgn Payroll"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Register</h3>
                            <p class="text-danger text-center"><?php echo $msg; ?></p>
							
							<!-- Account Form -->
							<form action="" method="post">
                            <div class="form-group">
									<label>Full name</label>
									<input class="form-control" type="text" name="name" required>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input class="form-control" type="email" name="email" required>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input class="form-control" type="password" name="password" required>
								</div>
								<div class="form-group">
									<label>Repeat Password</label>
									<input class="form-control" type="password" name="cpassword">
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit" name="submit">Register</button>
								</div>
								<div class="account-footer">
									<p>Already have an account? <a href="login.php">Login</a></p>
								</div>
							</form>
							<!-- /Account Form -->
						</div>
					</div>
				</div>
			</div>
        </div>