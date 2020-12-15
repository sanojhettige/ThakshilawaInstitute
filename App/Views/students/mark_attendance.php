<form method="post" action="" class="row">
    <div class="form-group col-md-3">
        <label for="name">Year</label>
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
        <span class="error-message"><?= isset($errors["name"]) ? $errors["name"]: ""; ?></span>
    </div>
    <div class="form-group col-md-3">
        <label for="address">Month</label>
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
        <span class="error-message"><?= isset($errors["address"]) ? $errors["address"]: ""; ?></span>
    </div>
    <div class="form-group col-md-3">
        <label for="email_address">Class</label>
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
        <span class="error-message"><?= isset($errors["email_address"]) ? $errors["email_address"]: ""; ?></span>
    </div>
    <div class="form-group col-md-3">

        <button style="margin-top:27px" type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
        <button style="margin-top:27px" type="reset" class="btn btn-default">Reset</button>
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
                    if($i == $today) {
                        $active = "active_date";
                    }  
                    ?>
                    <td class="<?= $active; ?>">
                        <input type="checkbox" class="form-control" name="check-<?= $i.'-'.$row['id']; ?>">
                    </td>
                    <?php } ?>
                <tr>
                    <?php } ?>
            </tbody>
    </table>
</div>
<?php } ?>