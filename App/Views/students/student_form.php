<form method="post" action="">
    <div class="form-group">
        <label for="name">Student Name</label>
        <input value="<?= get_post('name') ? get_post('name') : ($record ? $record['name'] : ''); ?>" type="text"
            class="form-control" required id="name" name="name" placeholder="">
        <span class="error-message"><?= isset($errors["name"]) ? $errors["name"]: ""; ?></span>
    </div>
    <div class="form-group">
        <label for="nic_no">NIC No</label>
        <input value="<?= get_post('nic_no') ? get_post('nic_no') : ($record ? $record['nic_no'] : ''); ?>" type="text"
            class="form-control" required id="nic_no" name="nic_no" placeholder="">
        <span class="error-message"><?= isset($errors["nic_no"]) ? $errors["nic_no"]: ""; ?></span>
    </div>
    <div class="form-group">
        <label for="gurdian_name">Guardian Name</label>
        <input
            value="<?= get_post('gurdian_name') ? get_post('gurdian_name') : ($record ? $record['gurdian_name'] : ''); ?>"
            type="text" class="form-control" required id="gurdian_name" name="gurdian_name" placeholder="">
        <span class="error-message"><?= isset($errors["gurdian_name"]) ? $errors["gurdian_name"]: ""; ?></span>
    </div>
    <div class="form-group">
        <label for="gurdian_contact_number">Guardian Contact Number</label>
        <input
            value="<?= get_post('gurdian_contact_number') ? get_post('gurdian_contact_number') : ($record ? $record['gurdian_contact_number'] : ''); ?>"
            type="text" class="form-control" required id="gurdian_contact_number" name="gurdian_contact_number"
            placeholder="">
        <span
            class="error-message"><?= isset($errors["gurdian_contact_number"]) ? $errors["gurdian_contact_number"]: ""; ?></span>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control" required id="address" name="address"
            rows="2"><?= get_post('address') ? get_post('address') : ($record ? $record['address'] : ''); ?></textarea>
        <span class="error-message"><?= isset($errors["address"]) ? $errors["address"]: ""; ?></span>
    </div>
    <div class="form-group">
        <label for="nic_no">Classess</label>
        <select class="form-control" name="class_id[]" id="class_id" multiple="multiple">
            <?php foreach($classess as $item) { ?>
            <?php if(in_array($item['id'], get_post('class_id[]')) || in_array($item['id'], $record['class_id'])) { ?>
            <option selected value="<?= $item['id']; ?>"><?= $item['class_name']; ?></option>
            <?php } else { ?>
            <option value="<?= $item['id']; ?>"><?= $item['class_name']; ?></option>
            <?php } ?>
            <?php } ?>
        </select>
        <span class="error-message"><?= isset($errors["class_id"]) ? $errors["class_id"]: ""; ?></span>
    </div>


    <input type="hidden" value="<?= $record ? $record['id'] : ''; ?>" name="_id">
    <button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-default">Reset</button>

</form>