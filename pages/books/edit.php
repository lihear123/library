<?php
include('../../config/db.php');
include('../../includes/header.php');

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = sqlsrv_prepare($conn, "UPDATE Books SET Title=?, Author=?, ISBN=?, Quantity=? WHERE BookID=?", [
        $_POST['title'], $_POST['author'], $_POST['isbn'], $_POST['quantity'], $id
    ]);
    if ($stmt && sqlsrv_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        echo "<p class='text-danger'>❌ Update failed.</p>";
    }
}

$stmt = sqlsrv_query($conn, "SELECT * FROM Books WHERE BookID = ?", [$id]);
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
?>
<h2>✏️ Edit Book</h2>
<form method="post">
    <input name="title" class="form-control mb-2" value="<?= $row['Title'] ?>" required>
    <input name="author" class="form-control mb-2" value="<?= $row['Author'] ?>">
    <input name="isbn" class="form-control mb-2" value="<?= $row['ISBN'] ?>">
    <input name="quantity" type="number" class="form-control mb-2" value="<?= $row['Quantity'] ?>" min="0" required>
    <button class="btn btn-warning">Update</button>
</form>
<?php include('../../includes/footer.php'); ?>
