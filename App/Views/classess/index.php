<?php if(is_permitted('classess-add')) { ?>
<div class="row component-header">
    <div class="col-md-8">
    </div>
    <div class="col-md-4">
        <a href="/classess/add" class="btn btn-success btn-sm pull-right"> Add New </a>
    </div>
</div>
<?php } ?>

<div class="table-responsive">
    <table id="class_datatable" class="table table-striped table-sm" url="/classess/get_classess">
        <thead>
            <tr>
                <th>ID</th>
                <th>Class Name</th>
                <th>Class Code</th>
                <th>Subject Name</th>
                <th>Lecturer Name</th>
                <th>Last Update Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Class Name</th>
                <th>Class Code</th>
                <th>Subject Name</th>
                <th>Lecturer Name</th>
                <th>Last Update Date</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>