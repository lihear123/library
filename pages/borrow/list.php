<?php
include('../../config/db.php');
include('../../includes/header.php');

$stmt = sqlsrv_query($conn, "
    SELECT b.BorrowID, m.Name AS MemberName, bk.Title AS BookTitle,
        b.BorrowDate, b.DueDate, b.ReturnDate
    FROM Borrowing b
    JOIN Members m ON b.MemberID = m.MemberID
    JOIN Books bk ON b.BookID = bk.BookID
    ORDER BY b.BorrowDate DESC
");
?>
<h2>📋 Borrowed Books List</h2>
<a href="borrow.php" class="btn btn-primary mb-2">+ Borrow New</a>
<table class="table table-bordered">
    <tr><th>Member</th><th>Book</th><th>Borrowed</th><th>Due</th><th>Returned</th><th>Action</th></tr>
    <?php while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) { ?>
    <tr>
        <td><?= $row['MemberName'] ?></td>
        <td><?= $row['BookTitle'] ?></td>
        <td><?= $row['BorrowDate']->format('Y-m-d') ?></td>
        <td><?= $row['DueDate']->format('Y-m-d') ?></td>
        <td><?= $row['ReturnDate'] ? $row['ReturnDate']->format('Y-m-d') : '❌ Not yet' ?></td>
        <td>
            <?php if (!$row['ReturnDate']) { ?>
                <a href="return.php?id=<?= $row['BorrowID'] ?>" class="btn btn-sm btn-success">Return</a>
            <?php } else { echo "✔️"; } ?>
        </td>
    </tr>
    <?php } ?>
</table>
<?php include('../../includes/footer.php'); ?>
