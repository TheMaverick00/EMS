
	<?php 
                       $id = $_SESSION['ID'];
                       $pro = mysqli_query($conn,"SELECT * FROM  employee WHERE id = '$id'");
					   $row = mysqli_fetch_array($pro);
					   
                     ?>

        <!-- Header -->
        <div class="header">

            <!-- Logo -->
            <div class="header-left">
                <a href="attendance-employee.php" class="logo">
                   SMA
                </a>
            </div>
            <!-- /Logo -->

            <a id="toggle_btn" href="javascript:void(0);">
                <span class="bar-icon">
                    <span></span>
                <span></span>
                <span></span>
                </span>
            </a>

            <!-- Header Title -->
            <div class="page-title-box">
                <h3>SMA</h3>
            </div>
            <!-- /Header Title -->

            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

            <!-- Header Menu -->
            <ul class="nav user-menu">

                <!-- Search -->
                <!-- <li class="nav-item">
                    <div class="top-nav-search">
                        <a href="javascript:void(0);" class="responsive-search">
                            <i class="fa fa-search"></i>
                        </a>
                        <form action="search.html">
                            <input class="form-control" type="text" placeholder="Search here">
                            <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </li> -->
                <!-- /Search -->

                <!-- Flag -->
                <li class="nav-item dropdown flag-nav">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                         <span>English</span>
                    </a>
                </li>
                <!-- /Flag -->

                <!-- Notifications -->
      
                <!-- /Notifications -->
          
                <!-- /Message Notifications -->

                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <?php if($row['picture']==""){
													?>
                        <span class="user-img"><img src="assets/img/profiles/avatar-21.jpg" alt="">
                           <span class="status online"></span>
                        </span> 

                    <?php }else{?>
                        <span><img src="pictures/<?php echo $row['picture'] ?>" alt="" width="30px" height="30px" style="border-radius:50px;">
                           <span class="status online" style="margin-left:-8px;margin-top:-20px"></span>
                        </span> 
                   <?php }?>
                        <span><?php echo $_SESSION['name']; ?></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="empprofile.php">My Profile</a>
                        <!-- <a class="dropdown-item" href="settings.html">Settings</a> -->
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
            <!-- /Header Menu -->

            <!-- Mobile Menu -->
            <div class="dropdown mobile-user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="empprofile.php">My Profile</a>
                    <!-- <a class="dropdown-item" href="settings.html">Settings</a> -->
                    <a class="dropdown-item" href="login.php">Logout</a>
                </div>
            </div>
            <!-- /Mobile Menu -->

        </div>
        <!-- /Header -->