<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">

        <?php $userRole = get_user_role(); ?>
        <ul class="nav nav-list flex-column">
            <?php if(in_array($userRole, array(1,2, 3, 4, 5, 6))) { ?>
            <li class="nav-item">
                <a class="nav-link active" href="/dashboard">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <?php } ?>
            <?php if(in_array($userRole, array(1))) { ?>
            <li class="nav-item">
                <a class="nav-link" href="/lecturers">
                    <span data-feather="file"></span>
                    Lecturers
                </a>
            </li>
            <?php } ?>
            <?php if(in_array($userRole, array(1,2,4))) { ?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-target="#classess">
                    <span data-feather="layers"></span>
                    Classess <span class="pull-right"><b class="caret"></b>
                </a>
                <ul class="nav-second-level collapse" id="classess">
                    <li class="nav-item">
                        <a class="nav-link" href="/classess">
                            <span class="nav-link-text">Class List</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/subjects">
                            <span class="nav-link-text">Subjects</span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <?php if(in_array($userRole, array(1,2,4))) { ?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-target="#students">
                    <span data-feather="layers"></span>
                    Students <span class="pull-right"><b class="caret"></b>
                </a>
                <ul class="nav-second-level collapse" id="students">
                    <li class="nav-item">
                        <a class="nav-link" href="/students">
                            <span class="nav-link-text">Student List</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/students/attendance">
                            <span class="nav-link-text">Attendance</span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <?php if(in_array($userRole, array(1,4,3,2))) { ?>
            <li class="nav-item">
                <a class="nav-link" href="/cafeteria">
                    <span data-feather="shopping-cart"></span>
                    Cafeteria
                </a>
            </li>
            <?php } ?>
            <?php if(in_array($userRole, array(1,2))) { ?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-target="#reports">
                    <span data-feather="layers"></span>
                    Reports <span class="pull-right"><b class="caret"></b>
                </a>
                <ul class="nav-second-level collapse" id="reports">
                    <?php if(in_array($userRole, array(2))) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/reports/income">
                            <span class="nav-link-text">Income</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/reports/expences">
                            <span class="nav-link-text">Expences</span>
                        </a>
                    </li>
                    <?php } ?>
                    <?php if(in_array($userRole, array(1))) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/reports/attendance">
                            <span class="nav-link-text">Attendance</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/reports/schedule">
                            <span class="nav-link-text">Class Schedule</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/reports/income">
                            <span class="nav-link-text">Income</span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>

            <?php if(in_array($userRole, array(1))) { ?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-target="#settings">
                    <span data-feather="layers"></span>
                    Settings <span class="pull-right"><b class="caret"></b>
                </a>
                <ul class="nav-second-level collapse" id="settings">
                    <li class="nav-item">
                        <a class="nav-link" href="/settings">
                            <span class="nav-link-text">System Settings</span>
                        </a>
                    </li>
                </ul>

            </li>
            <?php } ?>
            <?php if(in_array($userRole, array(1,2))) { ?>
            <li class="nav-item">
                <a class="nav-link" href="/users">
                    <span data-feather="layers"></span>
                    Users
                </a>
            </li>
            <?php } ?>
            <?php if(in_array($userRole, array(1,2, 3, 4, 5, 6))) { ?>
            <li class="nav-item">
                <a class="nav-link" href="/auth/profile">
                    <span data-feather="layers"></span>
                    Profile
                </a>
            </li>
            <?php } ?>

        </ul>

    </div>
</nav>