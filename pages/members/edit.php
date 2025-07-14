<?php
include('../../config/db.php');
include('../../includes/header.php');

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = sqlsrv_prepare($conn, "UPDATE Members SET Name=?, Email=?, Phone=? WHERE MemberID=?", [
        $_POST['name'], $_POST['email'], $_POST['phone'], $id
    ]);
    if ($stmt && sqlsrv_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        echo "<p class='text-danger'>❌ Failed to update.</p>";
    }
}

$stmt = sqlsrv_query($conn, "SELECT * FROM Members WHERE MemberID = ?", [$id]);
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
?>
<h2>✏️ Edit Member</h2>
<form method="post">
    <input name="name" class="form-control mb-2" value="<?= $row['Name'] ?>" required>
    <input name="email" type="email" class="form-control mb-2" value="<?= $row['Email'] ?>">
    <input name="phone" class="form-control mb-2" value="<?= $row['Phone'] ?>">
    <button class="btn btn-warning">Update</button>
</form>
<?php include('../../includes/footer.php'); ?>
