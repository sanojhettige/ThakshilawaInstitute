<form method="post" action="">
    <div class="form-group">
        <label for="name">Subject Name</label>
        <input value="<?= get_post('name') ? get_post('name') : ($record ? $record['subject_name'] : ''); ?>" type="text"
            class="form-control" required id="name" name="name" placeholder="">
        <span class="error-message"><?= isset($errors["name"]) ? $errors["name"]: ""; ?></span>
    </div>
    <div class="form-group">
        <label for="code">Subject Code</label>
        <input value="<?= get_post('code') ? get_post('nacodeme') : ($record ? $record['subject_code'] : ''); ?>" type="text"
            class="form-control" required id="code" name="code" placeholder="">
        <span class="error-message"><?= isset($errors["code"]) ? $errors["code"]: ""; ?></span>
    </div>
    <div class="form-group">
        <label for="notes">Subject Notes</label>
        <textarea class="form-control" required id="notes" name="notes"
            rows="2"><?= get_post('notes') ? get_post('notes') : ($record ? $record['notes'] : ''); ?></textarea>
        <span class="error-message"><?= isset($errors["notes"]) ? $errors["notes"]: ""; ?></span>
    </div>


    <input type="hidden" value="<?= $record ? $record['id'] : ''; ?>" name="_id">
    <button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-default">Reset</button>

</form>