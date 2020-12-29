<?php $roleId = get_session('role_id'); ?>
<div class="container">
    <div class="row">
        <?php if(in_array($userRole, array(1,2,3,4,5))) { ?>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="card">
                <img class="card-img-top" src="<?= BASE_URL.'/assets/img/teacher.png'; ?>" alt="Teacher">
                <div class="card-block">
                    <h4 class="card-title">Total Teachers</h4>
                    <p class="card-text">
                        <?= isset($totalTeachers) ? $totalTeachers : 0; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if(in_array($userRole, array(1,2,3,4,5,6))) { ?>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="card">
                <img class="card-img-top" src="<?= BASE_URL.'/assets/img/student.png'; ?>" alt="Student">
                <div class="card-block">
                    <h4 class="card-title">Total Students</h4>
                    <p class="card-text">
                        <?= isset($totalStudents) ? $totalStudents: 0; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if(in_array($userRole, array(1,2,3,4,5,6))) { ?>
        <div class="clearfix hidden-sm-down hidden-lg-up"></div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="card">
                <img class="card-img-top" src="<?= BASE_URL.'/assets/img/class.png'; ?>" alt="Class">
                <div class="card-block">
                    <h4 class="card-title">Total Classess</h4>
                    <p class="card-text">
                        <?= isset($totalClassess) ? $totalClassess : 0; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if(in_array($userRole, array(1,2,3,4,5,6))) { ?>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="card">
                <img class="card-img-top" src="<?= BASE_URL.'/assets/img/subject.png'; ?>" alt="Subject">
                <div class="card-block">
                    <h4 class="card-title">Total Subjects</h4>
                    <p class="card-text">
                        <?= isset($totalSubjects) ? $totalSubjects : 0; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if(in_array($userRole, array(1,2,3,4,5))) { ?>
        <!-- Purchases -->
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="card">
                <img class="card-img-top" src="<?= BASE_URL.'/assets/img/income.png'; ?>" alt="Income">
                <div class="card-block">
                    <h4 class="card-title">Income (Today)</h4>
                    <p class="card-text">
                        <?= isset($todayIncome) ? $todayIncome : 0; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if(in_array($userRole, array(1,2,3,4,5))) { ?>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="card">
                <img class="card-img-top" src="<?= BASE_URL.'/assets/img/income.png'; ?>" alt="Income">
                <div class="card-block">
                    <h4 class="card-title">Income (<?= date("M"); ?>)</h4>
                    <p class="card-text">
                        <?= isset($monthIncome) ? $monthIncome : 0; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if(in_array($userRole, array(1,2,3,4,5))) { ?>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="card">
                <img class="card-img-top" src="<?= BASE_URL.'/assets/img/income.png'; ?>" alt="Income">
                <div class="card-block">
                    <h4 class="card-title">Income (<?= date("Y"); ?>)</h4>
                    <p class="card-text">
                        <?= isset($yearIncome) ? $yearIncome: 0; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if(in_array($userRole, array(1,2,3,4,5))) { ?>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="card">
                <img class="card-img-top" src="<?= BASE_URL.'/assets/img/attendance.png'; ?>" alt="Attendance">
                <div class="card-block">
                    <h4 class="card-title">Attendance (Today)</h4>
                    <p class="card-text">
                        <?= isset($todayAttendance) ? $todayAttendance: 0; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if(in_array($userRole, array(1,2,3,4,5))) { ?>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="card">
                <img class="card-img-top" src="<?= BASE_URL.'/assets/img/attendance.png'; ?>" alt="Attendance">
                <div class="card-block">
                    <h4 class="card-title">Attendance (<?= date("M"); ?>)</h4>
                    <p class="card-text">
                        <?= isset($monthAttendance) ? $monthAttendance: 0; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if(in_array($userRole, array(1,2,3,4,5))) { ?>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="card">
                <img class="card-img-top" src="<?= BASE_URL.'/assets/img/attendance.png'; ?>" alt="Attendance">
                <div class="card-block">
                    <h4 class="card-title">Attendance (<?= date("Y"); ?>)</h4>
                    <p class="card-text">
                        <?= isset($yearAttendance) ? $yearAttendance: 0; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>