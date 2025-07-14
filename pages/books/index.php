<?php
include('../../config/db.php');
include('../../includes/header.php');
$stmt = sqlsrv_query($conn, "SELECT * FROM Books");
?>
<h2>📚 Book List</h2>
<a href="add.php" class="btn btn-primary mb-2">+ Add Book</a>
<table class="table table-bordered">
    <tr><th>BookID</th><th>Title</th><th>Author</th><th>ISBN</th><th>Qty</th><th>Actions</th></tr>
    <?php while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) { ?>
    <tr>
        <td><?= $row['BookID'] ?></td>
        <td><?= $row['Title'] ?></td>
        <td><?= $row['Author'] ?></td>
        <td><?= $row['ISBN'] ?></td>
        <td><?= $row['Quantity'] ?></td>
        <td>
            <a href="edit.php?id=<?= $row['BookID'] ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="delete.php?id=<?= $row['BookID'] ?>" class="btn btn-sm btn-danger"
            onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>
<?php include('../../includes/footer.php'); ?>
