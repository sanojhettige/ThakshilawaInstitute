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
        <label for="class_id">Class</label>
        <select class="form-control" name="class_id" id="class_id">
            <option value="">Select Class</option>
            <?php foreach($classess as $item) { ?>
            <?php if(get_post('class_id') == $item['id']) { ?>
            <option selected value="<?= $item['id']; ?>"><?= $item['class_name']; ?></option>
            <?php } else { ?>
            <option value="<?= $item['id']; ?>"><?= $item['class_name']; ?></option>
            <?php } ?>
            <?php } ?>
        </select>
        <span class="error-message"><?= isset($errors["class_id"]) ? $errors["class_id"]: ""; ?></span>
    </div>
    <div class="form-group col-md-3">

        <button style="margin-top:27px" type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
        <?php if(count($attendance)) { ?>
        <a style="margin-top:27px" class="btn btn-warning" target="_blank"
            href="/reports/attendance/student?print=1&year=<?= get_post('year_id'); ?>&month=<?= get_post('month_id'); ?>&class=<?= get_post('class_id'); ?>">Print</a>
        <?php } ?>
        <input type="hidden" name="selected_year_id" id="selected_year_id" value="<?= get_post('year_id'); ?>">
        <input type="hidden" name="selected_month_id" id="selected_month_id" value="<?= get_post('month_id'); ?>">
        <input type="hidden" name="selected_class_id" id="selected_class_id" value="<?= get_post('class_id'); ?>">
    </div>

</form>
<?php if($show_att) { ?>
<div class="row">
    <table class="table" style="width: 98%; display: block; overflow-x: auto; white-space: nowrap;">
        <thead>
            <th width="200">Student Name</th>
            <?php for($i = $start_date; $i <= $end_date; $i++) {
                $active = "";
                if($i == $today) {
                    $active = "active_date";
                }    
            ?>
            <th class="<?= $active; ?>">
                <?= $i; ?>
            </th>
            <?php } ?>
            <thead>
            <tbody>
                <?php foreach($attendance as $student=>$row) { ?>
                <tr>
                    <td><?= $student; ?></td>
                    <?php for($i = $start_date; $i <= $end_date; $i++) {
                    $active = "";
                    $checked = "";
                    $date = date("Y-m-d", strtotime(get_post('year_id').'-'.get_post('month_id').'-'.$i));
                    $checked = $row[$date] ? "/assets/img/check.png" : "/assets/img/crossed.png";
                    if($i == $today) {
                        $active = "active_date";
                    }  
                    ?>
                    <td>
                        <img src="<?= $checked; ?>" width="16px" />
                    </td>
                    <?php } ?>
                <tr>
                    <?php } ?>
            </tbody>
    </table>
</div>
<?php } ?>