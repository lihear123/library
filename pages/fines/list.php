<?php
include('../../config/db.php');
include('../../includes/header.php');

// Get all fines with member and book info
$stmt = sqlsrv_query($conn, "
    SELECT f.FineID, f.FineAmount, f.Paid,
        m.Name AS MemberName,
        bk.Title AS BookTitle,
        b.BorrowDate, b.DueDate, b.ReturnDate
    FROM Fines f
    JOIN Borrowing b ON f.BorrowID = b.BorrowID
    JOIN Members m ON b.MemberID = m.MemberID
    JOIN Books bk ON b.BookID = bk.BookID
    ORDER BY f.FineID DESC
");
?>
<h2>💸 Fines List</h2>
<table class="table table-bordered">
    <tr>
        <th>Member</th>
        <th>Book</th>
        <th>Borrowed</th>
        <th>Due</th>
        <th>Returned</th>
        <th>Amount (USD)</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) { ?>
        <tr>
            <td><?= $row['MemberName'] ?></td>
            <td><?= $row['BookTitle'] ?></td>
            <td><?= $row['BorrowDate']->format('Y-m-d') ?></td>
            <td><?= $row['DueDate']->format('Y-m-d') ?></td>
            <td><?= $row['ReturnDate'] ? $row['ReturnDate']->format('Y-m-d') : '❌ Not returned' ?></td>
            <td>$<?= number_format($row['FineAmount'], 2) ?></td>
            <td>
                <?= $row['Paid'] ? '<span class="text-success">✔️ Paid</span>' : '<span class="text-danger">❌ Unpaid</span>' ?>
            </td>
            <td>
                <?php if (!$row['Paid']) { ?>
                    <a href="pay.php?id=<?= $row['FineID'] ?>" class="btn btn-sm btn-success">Pay</a>
                <?php } else {
                    echo "—";
                } ?>
            </td>
        </tr>
    <?php } ?>
</table>
<?php include('../../includes/footer.php'); ?>