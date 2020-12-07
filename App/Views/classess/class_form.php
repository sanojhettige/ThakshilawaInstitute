<form method="post" action="">
<div class="row">
    <div class="form-group col-md-6">
        <label for="class_code">Class Code</label>
        <input value="<?= get_post('class_code') ? get_post('class_code') : ($record ? $record['class_code'] : ''); ?>" type="text"
            class="form-control" required id="class_code" name="class_code" placeholder="">
        <span class="error-message"><?= isset($errors["class_code"]) ? $errors["class_code"]: ""; ?></span>
    </div>
    <div class="form-group col-md-6">
        <label for="class_name">Class Name</label>
        <input value="<?= get_post('class_name') ? get_post('class_name') : ($record ? $record['class_name'] : ''); ?>" type="text"
            class="form-control" required id="class_name" name="class_name" placeholder="">
        <span class="error-message"><?= isset($errors["class_name"]) ? $errors["class_name"]: ""; ?></span>
    </div>
    <div class="form-group col-md-6">
        <label for="class_name">Lecturer Name</label>
        <select class="form-control" required id="lecturer_id" name="lecturer_id">
        <?php 
        $selected = "";
        foreach($lecturers as $lecturer) {
            if($record['lecturer_id'] == $lecturer['id']) {
                $selected = "selected";
            }
        ?>
        <option <?= $selected; ?> value="<?= $lecturer['id']; ?>"> <?= $lecturer['name']; ?></option>
        <?php } ?>
        </select>
        <span class="error-message"><?= isset($errors["lecturer_id"]) ? $errors["lecturer_id"]: ""; ?></span>
    </div>
    <div class="form-group col-md-6">
        <label for="class_name">Subject Name</label>
        <select class="form-control" required id="subject_id" name="subject_id">
        <?php 
        $selected = "";
        foreach($subjects as $subject) {
            if($record['subject_id'] == $subject['id']) {
                $selected = "selected";
            }
        ?>
        <option <?= $selected; ?> value="<?= $subject['id']; ?>"> <?= $subject['subject_name']; ?></option>
        <?php } ?>
        </select>
        <span class="error-message"><?= isset($errors["subject_id"]) ? $errors["subject_id"]: ""; ?></span>
    </div>
    <div class="form-group col-md-6">
        <label for="start_time">Start Time</label>
        <input value="<?= get_post('start_time') ? get_post('start_time') : ($record ? $record['start_time'] : ''); ?>" type="text"
            class="form-control" required id="start_time" name="start_time" placeholder="">
        <span class="error-message"><?= isset($errors["start_time"]) ? $errors["start_time"]: ""; ?></span>
    </div>
    <div class="form-group col-md-6">
        <label for="end_time">End Time</label>
        <input value="<?= get_post('end_time') ? get_post('end_time') : ($record ? $record['end_time'] : ''); ?>" type="text"
            class="form-control" required id="end_time" name="end_time" placeholder="">
        <span class="error-message"><?= isset($errors["end_time"]) ? $errors["end_time"]: ""; ?></span>
    </div>

    <div class="form-group col-md-12">
        <label for="notes">Notes</label>
        <textarea class="form-control" required id="notes" name="notes"
            rows="2"><?= get_post('notes') ? get_post('notes') : ($record ? $record['notes'] : ''); ?></textarea>
        <span class="error-message"><?= isset($errors["notes"]) ? $errors["notes"]: ""; ?></span>
    </div>

    <div class="form-group col-md-12">
    <input type="hidden" value="<?= $record ? $record['id'] : ''; ?>" name="_id">
    <button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-default">Reset</button>
    </div>
</div>
</form>