<form method="post" action="">
    <table class="table table-bordered">
        <tr>
            <td>Title</td>
            <td><?= ($record ? $record['title'] : ''); ?></td>
        </tr>
        <tr>
            <td>Type</td>
            <td><?= ($record ? $record['transaction_type'] : ''); ?></td>
        </tr>
        <tr>
            <td>Amount</td>
            <td><?= ($record ? $record['amount'] : ''); ?></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><?= ($record ? $record['description'] : ''); ?></td>
        </tr>
    </table>


    <input type="hidden" value="<?= $record ? $record['id'] : ''; ?>" name="_id">
    <?php if($record['id'] > 0 && $canDelete) { ?>
    <button type="submit" name="submit" value="1" class="btn btn-danger">Delete</button>
    <?php } ?>
    <a href="/lecturers" class="btn btn-default">Back To List</a>

</form>