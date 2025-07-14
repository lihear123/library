<?php
include('../../config/db.php');

$id = $_GET['id'];
sqlsrv_query($conn, "DELETE FROM Members WHERE MemberID = ?", [$id]);

header("Location: index.php");
exit;
?>
