<?php
include('../../config/db.php');

$id = $_GET['id'];
$stmt = sqlsrv_query($conn, "DELETE FROM Books WHERE BookID = ?", [$id]);

if ($stmt) {
    header("Location: index.php");
    exit;
} else {
    echo "❌ Failed to delete book.";
}
?>
