<?php
include('../../config/db.php');
include('../../includes/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = sqlsrv_prepare($conn, "INSERT INTO Books (Title, Author, ISBN, Quantity) VALUES (?, ?, ?, ?)", [
        $_POST['title'], $_POST['author'], $_POST['isbn'], $_POST['quantity']
    ]);
    if ($stmt && sqlsrv_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        echo "<p class='text-danger'>❌ Failed to add book.</p>";
    }
}
?>
<h2>➕ Add New Book</h2>
<form method="post">
    <input name="title" class="form-control mb-2" placeholder="Title" required>
    <input name="author" class="form-control mb-2" placeholder="Author">
    <input name="isbn" class="form-control mb-2" placeholder="ISBN">
    <input name="quantity" type="number" class="form-control mb-2" placeholder="Quantity" min="0" required>
    <button class="btn btn-primary">Save</button>
</form>
<?php include('../../includes/footer.php'); ?>
