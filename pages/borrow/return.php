<?php
include('../../config/db.php');
include('../../includes/header.php');

$borrowId = $_GET['id'] ?? null;
if (!$borrowId) die("❌ Borrow ID missing.");

// Fetch borrow record
$stmt = sqlsrv_query($conn, "SELECT * FROM Borrowing WHERE BorrowID = ?", [$borrowId]);
$data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

// Check for late return
$today = new DateTime();
$due = new DateTime($data['DueDate']->format('Y-m-d'));
$returnDate = $today->format('Y-m-d');
$lateDays = $today > $due ? $today->diff($due)->days : 0;
$finePerDay = 1.00;
$fine = $lateDays * $finePerDay;

// Update return date
$returnStmt = sqlsrv_prepare($conn, "UPDATE Borrowing SET ReturnDate = ? WHERE BorrowID = ?", [$returnDate, $borrowId]);
sqlsrv_execute($returnStmt);

// Insert fine if late
if ($lateDays > 0) {
    $fineStmt = sqlsrv_prepare($conn, "INSERT INTO Fines (BorrowID, FineAmount) VALUES (?, ?)", [$borrowId, $fine]);
    sqlsrv_execute($fineStmt);
}

echo "<div class='alert alert-info'>✅ Book returned. Fine: $fine USD</div>";
echo "<a href='list.php' class='btn btn-secondary'>Back to list</a>";

include('../../includes/footer.php');
?>
