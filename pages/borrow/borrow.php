<?php
include('../../config/db.php');
include('../../includes/header.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = sqlsrv_prepare($conn, "
        INSERT INTO Borrowing (MemberID, BookID, BorrowDate, DueDate)
        VALUES (?, ?, ?, ?)
    ", [
        $_POST['member_id'],
        $_POST['book_id'],
        $_POST['borrow_date'],
        $_POST['due_date']
    ]);

    if ($stmt && sqlsrv_execute($stmt)) {
        echo "<div class='alert alert-success'>✅ Book borrowed successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>❌ Borrowing failed.</div>";
    }
}

// Get members and books for dropdowns
$members = sqlsrv_query($conn, "SELECT MemberID, Name FROM Members");
$books = sqlsrv_query($conn, "SELECT BookID, Title FROM Books");
?>
<h2>📦 Borrow Book</h2>
<form method="post">
    <label>Member</label>
    <select name="member_id" class="form-control mb-2" required>
        <option value="">Select Member</option>
        <?php while($m = sqlsrv_fetch_array($members, SQLSRV_FETCH_ASSOC)) { ?>
            <option value="<?= $m['MemberID'] ?>"><?= $m['Name'] ?></option>
        <?php } ?>
    </select>

    <label>Book</label>
    <select name="book_id" class="form-control mb-2" required>
        <option value="">Select Book</option>
        <?php while($b = sqlsrv_fetch_array($books, SQLSRV_FETCH_ASSOC)) { ?>
            <option value="<?= $b['BookID'] ?>"><?= $b['Title'] ?></option>
        <?php } ?>
    </select>

    <label>Borrow Date</label>
    <input type="date" name="borrow_date" class="form-control mb-2" required>

    <label>Due Date</label>
    <input type="date" name="due_date" class="form-control mb-2" required>

    <button class="btn btn-primary">Borrow</button>
</form>
<?php include('../../includes/footer.php'); ?>
