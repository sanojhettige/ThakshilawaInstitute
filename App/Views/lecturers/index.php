<?php if(is_permitted('lecturers-add')) { ?>
<div class="row component-header">
    <div class="col-md-8">
    </div>
    <div class="col-md-4">
        <a href="/lecturers/add" class="btn btn-success btn-sm pull-right"> Add New </a>
    </div>
</div>
<?php } ?>

<div class="table-responsive">
    <table id="lecturer_datatable" class="table table-striped table-sm" url="/lecturers/get_lecturers">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>NIC No</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Last Update Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>NIC No</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Last Update Date</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>