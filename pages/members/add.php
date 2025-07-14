<?php
include('../../config/db.php');
include('../../includes/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = sqlsrv_prepare($conn, "INSERT INTO Members (Name, Email, Phone) VALUES (?, ?, ?)", [
        $_POST['name'], $_POST['email'], $_POST['phone']
    ]);
    if ($stmt && sqlsrv_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        echo "<p class='text-danger'>❌ Failed to add member.</p>";
    }
}
?>
<h2>➕ Add Member</h2>
<form method="post">
    <input name="name" class="form-control mb-2" placeholder="Name" required>
    <input name="email" type="email" class="form-control mb-2" placeholder="Email">
    <input name="phone" class="form-control mb-2" placeholder="Phone">
    <button class="btn btn-primary">Save</button>
</form>
<?php include('../../includes/footer.php'); ?>
