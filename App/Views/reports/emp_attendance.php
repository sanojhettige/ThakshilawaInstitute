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
        <!-- <button style="margin-top:27px" type="reset" class="btn btn-default">Reset</button> -->
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
                <?php foreach($students as $row) { ?>
                <tr>
                    <td><?= $row['name']; ?></td>
                    <?php for($i = $start_date; $i <= $end_date; $i++) {
                    $active = "";
                    $checked = "";
                    $date = date("Y-m-d", strtotime(get_post('year_id').'-'.get_post('month_id').'-'.$i));
                    $checked = $attendance[$row['id']][$date] ? "checked" : "";
                    if($i == $today) {
                        $active = "active_date";
                    }  
                    ?>
                    <td class="<?= $active; ?>">
                        <input <?= $checked; ?> type="checkbox" id="<?= $row['id']; ?>"
                            class="form-control att-checkbox" date="<?= $i; ?>" name="check-<?= $i.'-'.$row['id']; ?>">
                    </td>
                    <?php } ?>
                <tr>
                    <?php } ?>
            </tbody>
    </table>
</div>
<?php } ?>