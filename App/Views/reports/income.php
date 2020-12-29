<form method="post" action="" class="row">
    <div class="form-group col-md-3">
        <label for="year_id">Year</label>
        <select class="form-control" name="year_id" id="year_id">
            <option value="">Select Year</option>
            <?php foreach($years as $item) { ?>
            <?php if(get_post('year_id') == $item['id']) { ?>
            <option selected value="<?= $item['id']; ?>"><?= $item['title']; ?></option>
            <?php } else { ?>
            <option value="<?= $item['id']; ?>"><?= $item['title']; ?></option>
            <?php } ?>
            <?php } ?>
        </select>
        <span class="error-message"><?= isset($errors["year_id"]) ? $errors["year_id"]: ""; ?></span>
    </div>
    <div class="form-group col-md-3">
        <label for="month_id">Month</label>
        <select class="form-control" name="month_id" id="month_id">
            <option value="">Select Month</option>
            <?php foreach($months as $item) { ?>
            <?php if(get_post('month_id') == $item['id']) { ?>
            <option selected value="<?= $item['id']; ?>"><?= $item['title']; ?></option>
            <?php } else { ?>
            <option value="<?= $item['id']; ?>"><?= $item['title']; ?></option>
            <?php } ?>
            <?php } ?>
        </select>
        <span class="error-message"><?= isset($errors["month_id"]) ? $errors["month_id"]: ""; ?></span>
    </div>

    <div class="form-group col-md-3">

        <button style="margin-top:27px" type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
        <?php if(count($transactions)) { ?>
        <a style="margin-top:27px" class="btn btn-warning" target="_blank"
            href="/reports/income/print/<?= get_post('year_id'); ?>/<?= get_post('month_id'); ?>">Print</a>
        <?php } ?>
        <input type="hidden" name="selected_year_id" id="selected_year_id" value="<?= get_post('year_id'); ?>">
        <input type="hidden" name="selected_month_id" id="selected_month_id" value="<?= get_post('month_id'); ?>">
    </div>

</form>
<?php if($show_report) { ?>
<div class="row">
    <table class="table" style="width: 100%; overflow-x: auto; white-space: nowrap;">
        <thead>
            <th colspan="3" style="width: 50%;">Expences</th>
            <th colspan="3" style="width: 50%;">Income</th>
            <thead>
            <tbody>
                <tr>
                    <td>Date</td>
                    <td>Title</td>
                    <td>Amount</td>
                    <td>Date</td>
                    <td>Title</td>
                    <td>Amount</td>
                </tr>
                <?php 
                $received = 0;
                $expence = 0;
                foreach($transactions as $index=>$row) { 
                
                $received += $row['transaction_type'] === 1 ? $row['amount'] : 0;
                $expence += $row['transaction_type'] === 2 ? $row['amount'] : 0;
                ?>
                <tr>
                    <td><?= $row['transaction_type'] === 1 ? $row['created_at']: ''; ?></td>
                    <td><?= $row['transaction_type'] === 1 ? $row['title']: ''; ?></td>
                    <td><?= $row['transaction_type'] === 1 ? $row['amount']: ''; ?></td>
                    <td><?= $row['transaction_type'] === 2 ? $row['created_at']: ''; ?></td>
                    <td><?= $row['transaction_type'] === 2 ? $row['title'] : ''; ?></td>
                    <td><?= $row['transaction_type'] === 2 ? $row['amount'] : ''; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        <tfoot>
            <tr>
                <td colspan="2"></td>
                <td><?= $received; ?></td>
                <td colspan="2"></td>
                <td><?= $expence; ?></td>
            <tr>
        </tfoot>
    </table>
</div>
<?php } ?>