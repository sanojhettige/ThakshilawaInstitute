<form method="post" action="">
    <div class="form-group">
        <label for="name">Title</label>
        <input value="<?= get_post('title') ? get_post('title') : ($record ? $record['title'] : ''); ?>" type="text"
            class="form-control" required id="title" name="title" placeholder="">
        <span class="error-message"><?= isset($errors["title"]) ? $errors["title"]: ""; ?></span>
    </div>
    <div class="form-group">
        <label for="amount">Amount</label>
        <input value="<?= get_post('amount') ? get_post('amount') : ($record ? $record['amount'] : ''); ?>" type="text"
            class="form-control" required id="amount" name="amount" placeholder="">
        <span class="error-message"><?= isset($errors["amount"]) ? $errors["amount"]: ""; ?></span>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" required id="description" name="description"
            rows="2"><?= get_post('description') ? get_post('description') : ($record ? $record['description'] : ''); ?></textarea>
        <span class="error-message"><?= isset($errors["description"]) ? $errors["description"]: ""; ?></span>
    </div>



    <input type="hidden" value="<?= $record ? $record['id'] : ''; ?>" name="_id">
    <button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-default">Reset</button>

</form>