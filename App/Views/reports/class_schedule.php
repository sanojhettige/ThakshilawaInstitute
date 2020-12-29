<form method="post" action="" class="row">
    <div class="form-group col-md-3">
        <label for="class_id">Class</label>
        <select class="form-control" name="class_id" id="class_id">
            <option value="">All Classes</option>
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
        <?php if(count($schedules)) { ?>
        <a style="margin-top:27px" class="btn btn-warning" target="_blank"
            href="/reports/class_schedule/print/<?= get_post('class_id'); ?>">Print</a>
        <?php } ?>
        <input type="hidden" name="selected_class_id" id="selected_class_id" value="<?= get_post('class_id'); ?>">
    </div>

</form>
<?php if($show_report) { ?>
<div class="row">
    <table class="table" style="width: 100%; display: block; overflow-x: auto; white-space: nowrap;">
        <thead>
            <th width="30%">Class Name</th>
            <?php foreach($days as $index=>$day) { ?>
            <th width="10%">
                <?= $day['title']; ?>
            </th>
            <?php } ?>
            <thead>
            <tbody>
                <?php foreach($schedules as $class=>$row) { ?>
                <tr>
                    <td><?= $class; ?></td>
                    <?php foreach($days as $index=>$day) {
                    $active = "";
                    $checked = "";
                    $have = $row[$day['id']];
                    $sTime = date("h:i A", strtotime("2020-01-01 ".$row['data']['start_time']));
                    $eTime = date("h:i A", strtotime("2020-01-01 ".$row['data']['end_time']));
                    $checked = $have ? ($sTime .'-'.$eTime) : "-"; 
                    ?>
                    <td style="text-align:center;">
                        <?= $checked; ?><br />
                        <?php if($have) { ?>
                        <span><?= $row['data']['subject_name']; ?></span> <br />
                        <span><?= $row['data']['lecturer_name']; ?></span>
                        <?php } ?>
                    </td>
                    <?php } ?>
                <tr>
                    <?php } ?>
            </tbody>
    </table>
</div>
<?php } ?>