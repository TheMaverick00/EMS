<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="">
                    <a href="index"><i class="la la-dashboard"></i> <span> Dashboard</span></a>

                </li>

                <li class="menu-title">
                    <span>STAFF</span>
                </li>
                <li class="submenu">
                    <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Staff</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <?php 
                      if(isset($_SESSION['admin_status'])){

                    ?>
                        <li><a href="daily_task">Daily Task</a></li>
                        <!-- <li><a href="approval">Approval</a></li> -->

                        <?php
                      }
                        ?>
                        <li><a href="employees">All Staff</a></li>


                        <!-- <li><a href="leaves">Leaves</a></li> -->
                        <?php 
                      if(isset($_SESSION['admin_status'])){

                    ?>
                        <li><a href="attendance">Attendance (Admin)</a></li>
                        <?php
}?>
                        <li><a href="adminattendance">My Attendance</a></li>


                    </ul>
                </li>

                <li class="menu-title">
                    <span>HR</span>
                </li>
              
                <?php
                            if(isset($_SESSION['admin_status'])){
                            ?>
                        <li><a href="position"> <i class="la la-files-o"></i><span>  Position</span></a></li>
                        <?php
                            }
                            ?>
                
                <li class="submenu">
                    <a href="#"><i class="la la-money"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="salary"> Staff Salary </a></li>
                        <li><a href="allawance">Allowance </a></li>
                
                        <!-- payroll page for further work to do -->
                      

                    </ul>
                </li>



                <li class="menu-title">
                    <span class="text-uppercase">Administration</span>
                </li>
                <!-- <li>
                    <a href="asset"><i class="la la-object-ungroup"></i> <span>Assets</span></a>
                </li> -->

                <li>
                    <a href="users"><i class="la la-group"></i> <span>Staff</span></a>
                </li>

                <li>
                    <a href="attendance"><i class="la la-check-square"></i> <span>Attendance</span></a>
                </li>
               


            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->