<form method="post" action="">
    <div class="form-group">
        <label for="name">Student Name</label>
        <input readonly value="<?= get_post('name') ? get_post('name') : ($student ? $student['name'] : ''); ?>"
            type="text" class="form-control" required id="name" name="name" placeholder="">
        <span class="error-message"><?= isset($errors["name"]) ? $errors["name"]: ""; ?></span>
    </div>
    <div class="form-group">
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
    <div class="form-group">
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
        <span class="error-message"><?= isset($errors["month_id"]) ? $errors["month_id"]: ""; ?></span>
    </div>

    <div class="form-group">
        <label for="nic_no">Class</label>
        <select class="form-control" name="class_id" id="class_id">
            <?php foreach($classess as $item) { ?>
            <?php if(in_array($item['id'], get_post('class_id')) || in_array($item['id'], $student['class_id'])) { ?>
            <option value="<?= $item['id']; ?>"><?= $item['class_name']; ?></option>
            <?php } ?>
            <?php } ?>
        </select>
        <span class="error-message"><?= isset($errors["class_id"]) ? $errors["class_id"]: ""; ?></span>
    </div>
    <div class="form-group">
        <label for="paid_amount">Paid Amount</label>
        <input
            value="<?= get_post('paid_amount') ? get_post('paid_amount') : ($record ? $record['paid_amount'] : ''); ?>"
            type="text" class="form-control" required id="paid_amount" name="paid_amount" placeholder="">
        <span class="error-message"><?= isset($errors["paid_amount"]) ? $errors["paid_amount"]: ""; ?></span>
    </div>
    <div class="form-group">
        <label for="notes">Notes</label>
        <textarea class="form-control" required id="notes" name="notes"
            rows="2"><?= get_post('notes') ? get_post('notes') : ($record ? $record['notes'] : ''); ?></textarea>
        <span class="error-message"><?= isset($errors["notes"]) ? $errors["notes"]: ""; ?></span>
    </div>


    <input type="hidden" value="<?= $student ? $student['id'] : ''; ?>" name="student_id">
    <button type="submit" name="submit" value="1" class="btn btn-primary">Add Payment</button>
    <button type="submit" name="submit2" value="2" class="btn btn-primary">Check Payment</button>
    <button type="reset" class="btn btn-default">Reset</button>

    <br /><br />
</form>