<?php
include('../../config/db.php');

if (!isset($_GET['id'])) {
    die("❌ Fine ID is missing.");
}

$fineId = (int)$_GET['id'];

try {
    // Use SQLSRV functions properly
    $sql = "UPDATE Fines SET Paid = 1 WHERE FineID = ?";
    $params = [$fineId];

    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt && sqlsrv_execute($stmt)) {
        echo "<script>alert('✅ Fine paid successfully.');window.location.href='list.php';</script>";
    } else {
        echo "❌ Failed to mark as paid.";
    }

} catch (Exception $e) {
    echo "❌ Exception occurred: " . $e->getMessage();
}
?>
