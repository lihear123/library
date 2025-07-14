<?php
include('../../config/db.php');
include('../../includes/header.php');

$stmt = sqlsrv_query($conn, "SELECT * FROM Members");

?>
<h2>👤 Members List</h2>
<a href="add.php" class="btn btn-primary mb-2">+ Add Member</a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Actions</th>
    </tr>
    <?php while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) { ?>
    <tr>
        <td><?= $row['MemberID'] ?></td>
        <td><?= $row['Name'] ?></td>
        <td><?= $row['Email'] ?></td>
        <td><?= $row['Phone'] ?></td>
        <td>
            <a href="edit.php?id=<?= $row['MemberID'] ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="delete.php?id=<?= $row['MemberID'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this member?')">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>
<?php include('../../includes/footer.php'); ?>
