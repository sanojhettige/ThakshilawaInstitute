<form method="post" action="">
    <div class="form-group">
        <label for="name">Lecturer Name</label>
        <input value="<?= get_post('name') ? get_post('name') : ($record ? $record['name'] : ''); ?>" type="text"
            class="form-control" required id="name" name="name" placeholder="">
        <span class="error-message"><?= isset($errors["name"]) ? $errors["name"]: ""; ?></span>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control" required id="address" name="address"
            rows="2"><?= get_post('address') ? get_post('address') : ($record ? $record['address'] : ''); ?></textarea>
        <span class="error-message"><?= isset($errors["address"]) ? $errors["address"]: ""; ?></span>
    </div>
    <div class="form-group">
        <label for="email_address">Email address</label>
        <input
            value="<?= get_post('email_address') ? get_post('email_address') : ($record ? $record['email_address'] : ''); ?>"
            type="email" class="form-control" required id="email_address" name="email_address" placeholder="">
        <span class="error-message"><?= isset($errors["email_address"]) ? $errors["email_address"]: ""; ?></span>
    </div>
    <div class="form-group">
        <label for="phone">Phone Number</label>
        <input value="<?= get_post('phone') ? get_post('phone') : ($record ? $record['phone_number'] : ''); ?>"
            type="text" class="form-control" required id="phone" name="phone" placeholder="">
        <span class="error-message"><?= isset($errors["phone"]) ? $errors["phone"]: ""; ?></span>
    </div>
    <div class="form-group">
        <label for="nic_no">NIC No</label>
        <input value="<?= get_post('nic_no') ? get_post('nic_no') : ($record ? $record['nic_no'] : ''); ?>" type="text"
            class="form-control" required id="nic_no" name="nic_no" placeholder="">
        <span class="error-message"><?= isset($errors["nic_no"]) ? $errors["nic_no"]: ""; ?></span>
    </div>
    <!-- <div class="form-group">
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
    </div> -->


    <input type="hidden" value="<?= $record ? $record['id'] : ''; ?>" name="_id">
    <button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-default">Reset</button>

</form>