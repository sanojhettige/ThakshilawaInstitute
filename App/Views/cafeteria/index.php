<?php if(is_permitted('cafeteria-add')) { ?>
<div class="row component-header">
    <div class="col-md-6">
    </div>
    <div class="col-md-3">
        <a href="/cafeteria/expense" class="btn btn-success btn-sm pull-right"> Add Expense </a>
    </div>
    <div class="col-md-3">
        <a href="/cafeteria/income" class="btn btn-success btn-sm pull-right"> Add Income </a>
    </div>
</div>
<?php } ?>

<div class="table-responsive">
    <table id="transaction_datatable" class="table table-striped table-sm" url="/cafeteria/get_transactions">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Title</th>
                <th>Amount</th>
                <th>Transaction Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Title</th>
                <th>Amount</th>
                <th>Transaction Date</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>