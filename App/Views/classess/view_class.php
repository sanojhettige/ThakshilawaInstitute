<form method="post" action="">
    <table class="table table-bordered">
        <tr>
            <td>Subject Name</td>
            <td><?= ($record ? $record['subject_name'] : ''); ?></td>
        </tr>
        <tr>
            <td>Subject Code</td>
            <td><?= ($record ? $record['subjecT_code'] : ''); ?></td>
        </tr>
    </table>


    <input type="hidden" value="<?= $record ? $record['id'] : ''; ?>" name="_id">
    <?php if($record['id'] > 0 && $canDelete) { ?>
    <button type="submit" name="submit" value="1" class="btn btn-danger">Delete</button>
    <?php } ?>
    <a href="/subjects" class="btn btn-default">Back To List</a>

</form>